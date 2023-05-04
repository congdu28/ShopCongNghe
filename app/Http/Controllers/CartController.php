<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
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
        Session::forget('coupon');  // xóa chỉ session coupon

        return redirect()->back()->with('message','Đã xóa Giỏ hàng');
    }
}

// public function check_coupon(Request $request) {
//     $data = $request->all();
//     $coupon = Coupon::where('coupon_code', $data['coupon'])->first(); // trả về một bản ghi duy nhất.
//     if($coupon) {
//         $coupon_session = Session::get('coupon');
//         if($coupon_session == null) {
//             $cou = array(
//                 'coupon_code' => $coupon->coupon_code,
//                 'coupon_condition' => $coupon->coupon_condition,
//                 'coupon_number' => $coupon->coupon_number,
//             );
//             Session::put('coupon', [$cou]);
//             Session::save();
//             return redirect()->back()->with('message', 'Thêm mã giảm giá Thành công!');
//         } else {
//             $coupon_already_in_cart = false;
//             foreach($coupon_session as $cou) {
//                 if($cou['coupon_code'] == $coupon->coupon_code) {
//                     $coupon_already_in_cart = true;
//                     break;
//                 }
//             }
//             if($coupon_already_in_cart) {
//                 //Thêm một vòng lặp để kiểm tra xem mã giảm giá đã được thêm vào giỏ hàng hay chưa. 
//                 return redirect()->back()->with('message', 'Mã giảm giá đã được áp dụng!');
//             } else {
//                 $cou = array(
//                     'coupon_code' => $coupon->coupon_code,
//                     'coupon_condition' => $coupon->coupon_condition,
//                     'coupon_number' => $coupon->coupon_number,
//                 );
//                 Session::push('coupon', $cou); //thêm một phần tử vào mảng session coupon.
//                 Session::save();
//                 return redirect()->back()->with('message', 'Thêm mã giảm giá Thành công!');
//             }
//         }
//     } else {
//         return redirect()->back()->with('error', 'Mã giảm giá sai hoặc đã được sử dụng!');
//     }
// }

public function check_coupon(Request $request){
    $data = $request->all();
    $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
    if($coupon){
        $count_coupon = $coupon->count();
        if($count_coupon>0){
            $coupon_session = Session::get('coupon');
            if($coupon_session==true){
                $is_avaiable = 0;
                if($is_avaiable==0){
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session::put('coupon',$cou);
                }
            }else{
                $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                Session::put('coupon',$cou);
            }
            Session::save();
            return redirect()->back()->with('message','Thêm mã giảm giá thành công');
        }

    }else{
        return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã được sử dụng');
    }
}   

}
