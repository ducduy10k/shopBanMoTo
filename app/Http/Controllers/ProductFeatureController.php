<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductFeatureController extends Controller
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
     function add_product_feature(){
         $this->Authlogin();
        $product = DB::table('tbl_product')->orderby('product_id','desc')->get();
        $feature = DB::table('tbl_feature')->orderby('feature_id','desc')->get();

       return view('admin.add_product_feature')->with('product', $product)->with('feature', $feature);
   }
   
   function all_product_feature(){
    $this->Authlogin();
       $all_product_feature =  DB::table('tbl_product_feature')->join('tbl_product','tbl_product_feature.product_id','=','tbl_product.product_id')->join('tbl_feature','tbl_product_feature.feature_id','=','tbl_feature.feature_id')-> get();
       $manager_product_feature = view('admin.all_product_feature')->with('all_product_feature',$all_product_feature);
       return view('admin_layout')->with('admin.all_product_feature',$manager_product_feature);
   }
   function save_product_feature(Request $request){
    $this->Authlogin();
       $data  = array();
       $data['feature_id'] = $request->feature;
       $data['product_id'] = $request->product;
       $data['product_feature_name'] = $request->product_feature_name;
       $data['product_feature_value'] = $request->product_feature_value;
       $data['product_feature_price'] = $request->product_feature_price;
       $data['product_feature_status'] = $request->product_feature_status;
       $get_image = $request->file('product_feature_image');
       if($get_image){
        $get_image_name = $get_image->getClientOriginalName();
           $new_image =current(explode('.',$get_image_name)).rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/upload/product',$new_image);
           $data['product_feature_image'] = $new_image;
           DB::table('tbl_product_feature')->insert($data);
           Session::put('message','Thêm thương hiệu  thành công');
           return Redirect::to('add-product-feature');
       }
       $data['product_feature_image'] = '';
       DB::table('tbl_product_feature')->insert($data);
       Session::put('message','Thêm thương hiệu  thành công');
       return Redirect::to('add-product-feature');
      
   }
   function unactive_product_feature($product_feature_id){
    $this->Authlogin();
       DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->update(['product_feature_status'=>0]);
       Session::put('message','Không kích hoạt đặc trừng sản phẩm');
       return Redirect::to('all-product-feature');
   }
   function active_product_feature($product_feature_id){
    $this->Authlogin();
       DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->update(['product_feature_status'=>1]);
       Session::put('message','Kích hoạt đặc trừng sản phẩm');
       return Redirect::to('all-product-feature');
   }
   function edit_product_feature($product_feature_id){
    $this->Authlogin();
        $product = DB::table('tbl_product')->orderby('product_id','desc')->get();
         $feature = DB::table('tbl_feature')->orderby('feature_id','desc')->get();
       $edit_product_feature =  DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->get();
       $manager_product_feature = view('admin.edit_product_feature')->with('edit_product_feature',$edit_product_feature)->with('product', $product)->with('feature', $feature);
       return view('admin_layout')->with('admin.edit_product_feature',$manager_product_feature);
   }
   public function update_product_feature(Request $request,$product_feature_id){
    $this->Authlogin();
    $data  = array();
    $data['feature_id'] = $request->feature;
    $data['product_id'] = $request->product;
    $data['product_feature_name'] = $request->product_feature_name;
    $data['product_feature_value'] = $request->product_feature_value;
    $data['product_feature_price'] = $request->product_feature_price;
    $data['product_feature_status'] = $request->product_feature_status;

    $get_image = $request->file('product_feature_image');
    if($get_image){
        $get_image_name = $get_image->getClientOriginalName();
           $new_image =current(explode('.',$get_image_name)).rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/upload/product',$new_image);
           $data['product_feature_image'] = $new_image;
           DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->update($data);
           Session::put('message','Cập nhật đặc trưng sản phẩm thành công');
           return Redirect::to('all-product-feature');
       }
      
       DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->update($data);
       Session::put('message','Cập nhập đặc trưng sản phẩm thành công');
       return Redirect::to('all-product-feature');
   }
   public function delete_product_feature($product_feature_id){
    $this->Authlogin();
       DB::table('tbl_product_feature')->where('product_feature_id',$product_feature_id)->delete();
       Session::put('message','Xóa đặc trưng sản phẩm thành công');
       return Redirect::to('all-product-feature');
   }
}
