<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CheckoutController extends Controller
{
    //
    public function login_checkout(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product =  DB::table('tbl_product')->where('product_status','1')->orderby('brand_id','desc')->limit(6)->get();
    	return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
        
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
        $all_product =  DB::table('tbl_product')->where('product_status','1')->orderby('brand_id','desc')->limit(6)->get();
    	return view('pages.checkout.checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
        
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_phone'] = $request->shipping_phone;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);   
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
     
    }

    public function order_place(Request $request){
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
        $order_data['order_total'] = Cart::total();
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
            return view('pages.checkout.payment_on_dilivery');
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
}