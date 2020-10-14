<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class FeatureController extends Controller
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
     function add_feature(){
        $this->Authlogin();
       return view('admin.add_feature');
   }
   
   function all_feature(){
    $this->Authlogin();
       $all_feature =  DB::table('tbl_feature')->get();
       $manager_feature = view('admin.all_feature')->with('all_feature',$all_feature);
       return view('admin_layout')->with('admin.all_feature',$manager_feature);
   }
   function save_feature(Request $request){
    $this->Authlogin();
       $data  = array();
       $data['STT'] = $request->STT;
       $data['feature_name'] = $request->feature_name;
       $data['feature_desc'] = $request->feature_descreption;
       $data['feature_price'] = $request->feature_price;
       $data['feature_status'] = $request->feature_status;
       DB::table('tbl_feature')->insert($data);
       Session::put('message','Thêm thương hiệu  thành công');
       return Redirect::to('add-feature');
      
   }
   function unactive_feature($feature_id){
    $this->Authlogin();
       DB::table('tbl_feature')->where('feature_id',$feature_id)->update(['feature_status'=>0]);
       Session::put('message','Không kích hoạt đặc trưng sản phẩm');
       return Redirect::to('all-feature');
   }
   function active_feature($feature_id){
    $this->Authlogin();
       DB::table('tbl_feature')->where('feature_id',$feature_id)->update(['feature_status'=>1]);
       Session::put('message','Kích hoạt đặc trưng sản phẩm');
       return Redirect::to('all-feature');
   }
   function edit_feature($feature_id){
    $this->Authlogin();
       $edit_feature =  DB::table('tbl_feature')->where('feature_id',$feature_id)->get();
       $manager_feature = view('admin.edit_feature')->with('edit_feature',$edit_feature);
       return view('admin_layout')->with('admin.edit_feature',$manager_feature);
   }
   public function update_feature(Request $request,$feature_id){
    $this->Authlogin();
       $data  = array();
       $data['brand_name'] = $request->brand_product_name;
       $data['brand_desc'] = $request->brand_product_decreption;
       DB::table('tbl_feature')->where('feature_id',$feature_id)->update($data);
       Session::put('message','Cập nhập thương hiệu thành công');
       return Redirect::to('all-brand-product');
   }
   public function delete_feature($feature_id){
    $this->Authlogin();
       DB::table('tbl_feature')->where('feature_id',$feature_id)->delete();
       Session::put('message','Xóa đặc trưng thành công');
       return Redirect::to('all-brand-product');
   }
}
