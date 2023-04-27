<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class CartController extends Controller
{
    
    public function gio_hang(Request $request){
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();

        $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('meta_desc',$meta_desc)->with('brand',$brand_product)->with('category',$cate_product)->with('brand',$brand_product)
        ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function save_cart(Request $request){  
      $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
      $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
      $productId= $request->productid_hidden;
      $qty = $request->quantity;

      $data =  DB::table('product')->where('product_id',$productId)->get();
      
      return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }

//     public function add_cart_ajax(Request $request){
//         $data = $request->all();
//        $session_id = substr(md5(microtime()),rand(0,26),5);
//        $cart = Session::get('cart');
//        if($cart == true){
//           $is_available = 0;
//           foreach($cart as $val){
//             if($val['product_id']== $data['product_id']){
//                 $is_available++;
//             }
//           }
//           if($is_available = 0){
//             $cart[]= array(
//                 'session_id' => $session_id,
//                 'product_name' => $data['cart_product_name'],
//                 'product_id' => $data['cart_product_id'],
//                 'product_image' => $data['cart_product_image'],
//                 'product_qty' =>$data['cart_product_qty'],
//                 'product_price' =>$data['cart_product_price']
//             );
//             Session::put('cart',$cart);
//           }
//        }else{
//         $cart[]= array(
//             'session_id' => $session_id,
//             'product_name' => $data['cart_product_name'],
//             'product_id' => $data['cart_product_id'],
//             'product_image' => $data['cart_product_image'],
//             'product_qty' =>$data['cart_product_qty'],
//             'product_price' =>$data['cart_product_price']
         
//         );
//        }
//        Session::put('cart',$cart);
//        Session::save()
// ;    }

public function add_cart_ajax(Request $request){
  $data = $request->all();
  $session_id = substr(md5(microtime()),rand(0,26),5);
  $cart = Session::get('cart');
  if($cart==true){
      $is_avaiable = 0;
      foreach($cart as $key => $val){
          if($val['product_id']==$data['cart_product_id']){
              $is_avaiable++;
          }
      }
      if($is_avaiable == 0){
          $cart[] = array(
          'session_id' => $session_id,
          'product_name' => $data['cart_product_name'],
          'product_id' => $data['cart_product_id'],
          'product_image' => $data['cart_product_image'],
          'product_qty' => $data['cart_product_qty'],
          'product_price' => $data['cart_product_price'],
          );
          Session::put('cart',$cart);
      }
  }else{
      $cart[] = array(
          'session_id' => $session_id,
          'product_name' => $data['cart_product_name'],
          'product_id' => $data['cart_product_id'],
          'product_image' => $data['cart_product_image'],
          'product_qty' => $data['cart_product_qty'],
          'product_price' => $data['cart_product_price'],

      );
      Session::put('cart',$cart);
  }
 
  Session::save();

}  

public function delete_cart_product($session_id){
    $cart = Session::get('cart');
    if($cart == true){
        foreach($cart as $key => $val){
            if($val["session_id"]==$session_id){
                unset($cart[$key]);     // kiểm tra xem session id có thay đôi ko , nếu thay đổi sẽ xóa, nếu ko thì thôi
            }
        }
        Session::put('cart',$cart);
        return redirect()->back()->with('message','Xóa Sản Phẩm Thành Công');
    }
}

public function update_cart_quantity(Request $request){
   $data = $request->all();
   $cart = Session::get('cart');
   if($cart==true){
    foreach($data['cart_qty'] as $key =>$qty){
       foreach($cart as $session =>$val){
        if($val['session_id']==$key){
            $cart[$session]['product_qty']= $qty;
        }
       }
    }
      Session::put('cart',$cart);
      return redirect()->back()->with('message','Cập nhật Sản Phẩm Thành Công');
   }else{
      return redirect()->back()->with('message','Cập nhật Sản Phẩm Không Thành Công');
   }
}

public function delete_all_cart(Request $request){
    $cart = Session::get('cart');
    if($cart==true){
        Session::forget('cart');  // xóa chỉ session cart
        return redirect()->back()->with('message','Đã xóa Giỏ hàng');
    }
}

public function check_coupon(Request $request){
   $data = $request->all();
   print_r($data);
}
}
