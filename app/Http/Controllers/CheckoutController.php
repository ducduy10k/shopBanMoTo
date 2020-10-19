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