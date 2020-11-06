<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;



class CheckoutController extends Controller
{
    //
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=='city'){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output .= ' <option value="">--Chọn quận huyện--</option>';
                foreach($select_province as $key =>$province){
                    $output .= ' <option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output .= ' <option value="">--Chọn phường xã --</option>';
                foreach($select_wards as $key =>$wards){
                    $output .= ' <option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                } 
            }
            echo $output;
        }
    }
    public function login_checkout(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();

        return view('pages.checkout.login_checkout')->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_shop', $all_shop)
        ->with('all_slide',$slide_product)
        ;
        
    }

    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customer')->insertGetId($data);   
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);     
        return Redirect::to('/checkout');

    }

    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();
        $city = City::orderby('matp','ASC')->get();
        return view('pages.checkout.checkout')
        ->with('all_shop', $all_shop)
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_slide',$slide_product)
        ->with('city',$city);
    }

    public function save_checkout_customer(Request $request){
        $data = $request->all();
        $data1 = array();
        $data1['shipping_name'] = $request->shipping_name;
        $data1['shipping_email'] = $request->shipping_email;
        $data1['shipping_address'] = $request->shipping_address;
        $data1['shipping_notes'] = $request->shipping_notes;
        $data1['shipping_phone'] = $request->shipping_phone;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data1);  
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{ 
                    Session::put('fee',25000);
                    Session::save();
                }
            }
           
        }
        Session::put('shipping_id',$shipping_id);
        //return Redirect::to('/payment');
    }

    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();
        
        return view('pages.checkout.payment')
        ->with('category', $cate_product)->with('all_shop', $all_shop)
        ->with('brand', $brand_product)->with('all_slide',$slide_product);
     
    }

    public function order_place(Request $request){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();
     
        //payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        // order
        $order_data = array();
        $customer_id =Session::get('customer_id');
        $shipping_id =Session::get('shipping_id');
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        if(Session::get('coupon')){
            foreach(Session::get('coupon') as $key =>$cou){
              
                  $order_data['coupon_code'] = $cou['coupon_code'] ;
                  if($cou['coupon_condition']==1){
                    $order_data['order_total'] =  round(
                        floatval(preg_replace("/[^-0-9\.]/","",Session::get('fee')))*$cou['coupon_number']/100 +
                        floatval(preg_replace("/[^-0-9\.]/","",Cart::total())),-0);
                  }
                  else if($cou['coupon_condition']==2){
                    $order_data['order_total'] = round(floatval(preg_replace("/[^-0-9\.]/","",Cart::priceTotal())) + Session::get('fee') - $cou['coupon_number'],-3);
                  }
                  else{
                    $order_data['order_total'] =round(floatval(preg_replace("/[^-0-9\.]/","",Cart::total())),-4);
                  }

            }
        }else{
             $order_data['coupon_code'] = '';
            $order_data['order_total'] = round(floatval(preg_replace("/[^-0-9\.]/","",Cart::total())),-4);
      
        }
      
         $order_data['order_status'] = "Đang chờ xử lý";
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        // order detail
        $content = Cart::content();
        foreach($content as $item){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] =  $item->id;
            $order_d_data['product_name'] = $item->name;
            $order_d_data['order_quantity'] = $item->qty;
            $order_d_data['order_price'] = $item->price;
            DB::table('tbl_order_detail')->insert($order_d_data);
        }
       // echo print_r($content);
        if($data['payment_method']==1){

        }elseif($data['payment_method']==2){
            Cart::destroy();
            return view('pages.checkout.payment_on_delivery')
            ->with('category', $cate_product)->with('brand', $brand_product)
            ->with('all_slide',$slide_product)
            ->with('all_shop', $all_shop);
        }
        else{

        }
        return Redirect::to('/payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
       $email = $request->name_account;
       $password = md5($request->pass_account);
       $result = DB::table('tbl_customer')
       ->where('customer_email',$email)
       ->where('customer_password',$password)
       ->first();
       if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }
        else{
            return Redirect::to('/login-checkout');
        }
    }

    public function login_facebook($id){
        Session::put('customer_id',$id);
    }
}