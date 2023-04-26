<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class BrandProduct extends Controller
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
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product =   DB::table('brand')->get();
      
        return view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    }


    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
       $data = array();
       $data['brand_name'] = $request->brand_name;
       $data['brand_des'] = $request->brand_des;
       $data['brand_status'] = $request->brand_status;
       
      DB::table('brand')->insert($data);
      Session::put('message','Thêm Thương Hiệu Thành Công!');
      return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Đã ẩn Thương Hiệu!');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Hiển thị Thương Hiệu Thành Công!');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product =   DB::table('brand')->where('brand_id',$brand_product_id)->get();   


        return view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_des'] = $request->brand_des;
        DB::table('brand')->where('brand_id',$brand_product_id)->update($data);   
        Session::put('message','Cập Nhật Thương Hiệu Thành Công!');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){  
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_product_id)->delete();   
        Session::put('message','Xóa Thương Hiệu Thành Công!');
        return Redirect::to('all-brand-product');
    }
    // END ADMIN


    // Show Brand, Home page , show sản phẩm theo từng thương hiệu
    public function show_brand_home($brand_id){
        $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
  
        $brand_by_id = DB::table('product')->join('brand','product.brand_id','=','brand.brand_id')
        ->where('product.brand_id',$brand_id)->get();

           // lấy tên theo brand click
        $brand_name = DB::table('brand')->where('brand.brand_id',$brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
}
