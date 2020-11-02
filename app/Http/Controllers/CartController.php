<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Cart;
use Session ;
use App\Http\Requests;
use App\coupon;
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
         $data['weight'] =  $quantity;
        $data['name'] =  $product_info->product_name;
        $data['price'] =  $product_info->product_price;
        $data['options']['image'] =  $product_info->product_image;
      
        
      //    Cart::add('293ad', 'Product 1', 1, 9.99, 550);
          Cart::add($data);
           return Redirect::to('/show-cart');
       }

     public function show_cart($scrollY=0){
      
          $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
           $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slide_product = DB::table('tbl_slide_home')->where('slide_status','1')->orderby('slide_id','desc')->get();
        $all_shop =DB::table('tbl_shop_info')->where('shop_status','1')->orderby('shop_id','asc')->get();

          return view('pages.cart.show_cart')
          ->with('category', $cate_product)
          ->with('brand', $brand_product)
          ->with('all_slide',$slide_product)
          ->with('all_shop', $all_shop);
        
     }
     
          
     public function delete_cart($rowId){
      Cart::update($rowId, 0); // Will update the quantity
      return Redirect::to('/show-cart');
     }

     public function increase_cart($rowId){
    
      Cart::update($rowId, Cart::get($rowId)->qty + 1);
      return Redirect::to('/show-cart');
     }

     public function reduce_cart($rowId){
      Cart::update($rowId, Cart::get($rowId)->qty - 1);
      return Redirect::to('/show-cart');
     }
     public function update_cart(Request $request){
      Cart::update($request->id, $request->val);
      //return Redirect::to('/show-cart');
     }

     public function check_coupon(Request $request){
      $data = $request->all();
      $coupon = coupon::where('coupon_code',$data['coupon'])->first();
      if($coupon){
        $count_coupon = $coupon->count();
        if($count_coupon>0){
          $coupon_session = Session::get('coupon');
          if($coupon_session==true){
            $is_availabe = 0;
            if($is_availabe  == 0){
              $cou[] = array(
                'coupon_code'=>$coupon->coupon_code,
                'coupon_condition'=>$coupon->coupon_condition,
                'coupon_number'=>$coupon->coupon_number,

              );
              Session::put('coupon',$cou);
            }
          }
          else{
            $cou[] = array(
              'coupon_code'=>$coupon->coupon_code,
              'coupon_condition'=>$coupon->coupon_condition,
              'coupon_number'=>$coupon->coupon_number,

            );
            Session::put('coupon',$cou);
          }
          Session::save();
          return redirect()->back()->with('message','Thêm mã thành công');
        }
      }else{
        Session::forget('coupon');
        return redirect()->back()->with('error','Mã  giảm giá không đúng');
      }
    }
  
}