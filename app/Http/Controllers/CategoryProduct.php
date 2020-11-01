<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
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
    function add_category_product(){
        $this->Authlogin();
        return view('admin.add_category_product');
    }
    
    function all_category_product(){
        $this->Authlogin();
        $all_category_product =  DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    function save_category_product(Request $request){
        $this->Authlogin();
        $data  = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_decreption;
        $data['category_status'] = $request->category_product_status;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm dah mục thành công');
        return Redirect::to('add-category-product');
       
    }
    function unactive_category_product($category_product_id){
        $this->Authlogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Không kích hoạt danh mục sản phẩm');
        return Redirect::to('all-category-product');
    }
    function active_category_product($category_product_id){
        $this->Authlogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm');
        return Redirect::to('all-category-product');
    }
    function edit_category_product($category_product_id){
        $this->Authlogin();
        $edit_category_product =  DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->Authlogin();
        $data  = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_decreption;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhập danh mục thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->Authlogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-category-product');
    }


    //End function admin page
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)
        ->paginate(9);
        $category_name =  DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_slide',$slide_product)
        ->with('category_by_id', $category_by_id)
        ->with('category_name', $category_name);
    }  
    
   

}
