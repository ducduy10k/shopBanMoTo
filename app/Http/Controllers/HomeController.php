<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
   
    //
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product =  DB::table('tbl_product')
        // ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        // ->get();
        $all_product =  DB::table('tbl_product')->where('product_status','1')->orderby('brand_id','desc')->limit(6)->get();
    	return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function search(Request $request){
        $keyword = $request->keywords;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product =  DB::table('tbl_product')
        // ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        // ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        // ->get();
        $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
    	return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
 
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
}
