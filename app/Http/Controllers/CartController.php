<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session ;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
       public function save_cart(Request $request){
            $productId = $request->productid_hidden;
            $quantity = $request->qty;
          $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        $data['id'] =  $productId;
        $data['qty'] =  $quantity;
        $data['name'] =  $product_info->product_name;
        $data['price'] =  $product_info->product_price;
        $data['option']['image'] =  $product_info->product_image;
           Cart::add($data);
           return Redirect::to('/show_cart');
          
       }
     public function show_cart(){
         
          $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
           $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
          return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
     }
  
}
