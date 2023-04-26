<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        // auth ko cho khách vào thẳng admin
       $admin_id = Session::get('admin_id'); // check xem có admin_id ko, nếu ko sẽ quay về đăng nhập
       if($admin_id){
        return Redirect::to('dashboard');
       }else{
        return Redirect::to('admin')->send();
       }
      
      }
    public function all_product(){
        $this->AuthLogin();
        $all_product =   DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->orderBy('product.product_id','desc')->get();
      
        return view('admin.all_product')->with('all_product',$all_product);
    }


    public function add_product(){
        $this->AuthLogin();
        // lay ra ten danh muc va thuong hieu
        $cate_product = DB::table('category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->orderBy('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_price'] = $request->product_price;
       $data['product_des'] = $request->product_des;
       $data['category_id'] = $request->product_cate;
       $data['brand_id'] = $request->product_brand;
       $data['product_content'] = $request->product_content;
       $data['product_status'] = $request->product_status;
       $get_image = $request-> file('product_image');
       if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));  // lay ten dau tien cua anh phan tach dau .jpg
        $new_image = $name_image. rand(0,99).'.'. $get_image->getClientOriginalExtension();
        $get_image->move('uploads/products',$new_image);
        $data['product_image'] = $new_image;
        DB::table('product')->insert($data);
        Session::put('message','Thêm Sản Phẩm Thành Công!');
        return Redirect::to('add-product');
       }
       $data['product_image'] = '';

      DB::table('product')->insert($data);
      Session::put('message','Thêm Sản Phẩm Thành Công!');
      return Redirect::to('all-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Đã ẩn  Sản Phẩm!');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Hiển thị  Sản Phẩm Thành Công!');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->orderBy('brand_id','desc')->get();
        $edit_product =   DB::table('product')->where('product_id',$product_id)->get();   
         
        return view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }

    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_des'] = $request->product_des;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;

        $get_image = $request-> file('product_image');
        if($get_image){
         $get_name_image = $get_image->getClientOriginalName();
         $name_image = current(explode('.',$get_name_image));  // lay ten dau tien cua anh phan tach dau .jpg
         $new_image = $name_image. rand(0,99).'.'. $get_image->getClientOriginalExtension();
         $get_image->move('uploads/products',$new_image);
         $data['product_image'] = $new_image;
         DB::table('product')->where('product_id',$product_id)->update($data);
         Session::put('message','Cập Nhật Sản Phẩm Thành Công!');
         return Redirect::to('all-product');
        }
        DB::table('product')->where('product_id',$product_id)->update($data);   
        Session::put('message','Cập Nhật Sản Phẩm Thành Công!');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id){  
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->delete();   
        Session::put('message','Xóa Sản Phẩm Thành Công!');
        return Redirect::to('all-product');
    }
    // END ADMIN


    // Chi tiết sản phẩm
    public function show_detail_product($product_id){  
        $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();

        $detail_product =   DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('product.product_id',$product_id)->get();
        
        // lấy detail product thuộc category
        foreach($detail_product as $detail_pro){
            $category_id = $detail_pro ->category_id  ; 
        }
        
        $related_product =   DB::table('product')
        ->join('category_product','category_product.category_id','=','product.category_id')
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->where('product.category_id',$category_id)->whereNotIn('product.product_id',[$product_id])->get();
        
        return view('pages.product.show_detail')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('detail_product',$detail_product)->with('related_product',$related_product);
    }
}
