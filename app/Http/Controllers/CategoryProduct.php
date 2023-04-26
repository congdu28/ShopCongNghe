<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class CategoryProduct extends Controller
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
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product =   DB::table('category_product')->get();
        // $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin.all_category_product')->with('all_category_product',$all_category_product);
    }


    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
       $data = array();
       $data['category_name'] = $request->category_name;
       $data['category_des'] = $request->category_des;
       $data['category_status'] = $request->category_status;
       
      DB::table('category_product')->insert($data);
      Session::put('message','Thêm Danh Mục Thành Công!');
      return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Đã ẩn Danh Mục!');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Hiển thị Thành Công!');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product =   DB::table('category_product')->where('category_id',$category_product_id)->get();   


        return view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_des'] = $request->category_des;
        DB::table('category_product')->where('category_id',$category_product_id)->update($data);   
        Session::put('message','Cập Nhật Danh Mục Thành Công!');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){  
        $this->AuthLogin();
        DB::table('category_product')->where('category_id',$category_product_id)->delete();   
        Session::put('message','Xóa Danh Mục Thành Công!');
        return Redirect::to('all-category-product');
    }
    // END ADMIN


    // Show category, Home page , show sản phẩm theo từng danh mục
    public function show_category_home($category_id){
        $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
  
        $category_by_id = DB::table('product')->join('category_product','product.category_id','=','category_product.category_id')
        ->where('product.category_id',$category_id)->get();
         // lấy tên theo category click
        $category_name = DB::table('category_product')->where('category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
