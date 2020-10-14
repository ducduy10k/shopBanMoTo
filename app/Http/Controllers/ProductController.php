<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    function Authlogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');

        }
        else{
            return Redirect::to('admin')->send();
        }
    }
     //
     function add_product(){
        $this->Authlogin();
         $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
         $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('category_product', $cate_product)->with('brand_product', $brand_product);
    }
    
    function all_product(){
        $this->Authlogin();
        $all_product =  DB::table('tbl_product')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    function save_product(Request $request){
        $this->Authlogin();
        $data  = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_descreption;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        $get_image = $request->file('product_image');
        if($get_image){
         $get_image_name = $get_image->getClientOriginalName();
            $new_image =current(explode('.',$get_image_name)).rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
       
    }
    function unactive_product($product_id){
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm');
        return Redirect::to('all-product');
    }
    function active_product($product_id){
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm');
        return Redirect::to('all-product');
    }
    function edit_product($product_id){
        $this->Authlogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product =  DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->Authlogin();
        $data  = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_descreption;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhập sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->Authlogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    // End function admin page
    public function detail_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $detail_product =  DB::table('tbl_product')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();
        foreach($detail_product as $key =>$val){
            $cate_id = $val->category_id;
            $brand_id = $val->brand_id;
        }

       
        $related_product =  DB::table('tbl_product')
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$cate_id)
        ->where('tbl_product.brand_id',$brand_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])
        ->get();
        return view('pages.product.show_detail')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('detail_product', $detail_product)->with('related_product', $related_product);
    }
}
