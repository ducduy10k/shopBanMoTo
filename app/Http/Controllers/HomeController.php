<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Mail;
use Session ;
use App\Rules\Captcha; 
use Validator;  
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
   
    //
    public function index(Request $request){
        //seo 
        $meta_desc = "Chuyên bán moto giá tốt nhất Việt Nam";
        $meta_keywords ='Moto , xe máy , xe máy giá rẻ';
        $meta_title = 'Shop mô tô';
        $url_canonical = $request->url();
        //end seo
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product =  DB::table('tbl_product')
        // ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        // ->get();
        $all_product =  DB::table('tbl_product')->where('product_status','1')->orderby('brand_id','desc')->limit(6)->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)
        ->with('all_slide',$slide_product)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ->with('all_shop',$all_shop);
    }

    public function search(Request $request){
        $keyword = $request->keywords;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();

        $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.product.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_slide',$slide_product)
        ->with('search_product', $search_product)
        ->with('all_shop',$all_shop);
    }

    public function printer(){
    	return view('printer');
    }

    public function iframe_printer(){
    	return view('iframe_printer');
    }

    public function login_injection(){
    	return view('login_injection');
    }

    public function send_mail(){
         //send mail
         $to_name = "N Duy";
         $to_email = "ducduy10k@gmail.com";//send to this email
         $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
         Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
             $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
             $message->from($to_email,$to_name);//send from this mail
         });
    }

    public function send_message(Request $request){
        $data = $request->validate([
            'customer_phone' => 'required',
            'content_message' => 'required',
            'customer_name' => 'required',
           'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
        ]);

        $data  = array();
        $data['customer_phone'] = $request->customer_phone;
        $data['content_message'] = $request->content_message;
        $data['customer_name'] = $request->customer_name;
        DB::table('tbl_message_request')->insert($data);
        Session::put('message','Đã gửi thành công');
        return Redirect::to('/');
    }

    public function send_phone(Request $request){
        $data = $request->validate([
            'phone_number' => 'required',
           'g-recaptcha-response-phone' => new Captcha(), 		//dòng kiểm tra Captcha
        ]);

        $data  = array();
        $data['phone'] = $request->phone_number;
        DB::table('tbl_phone_request')->insert($data);
        Session::put('message','Đã gửi thành công');
        return Redirect::to('/');
    }
}