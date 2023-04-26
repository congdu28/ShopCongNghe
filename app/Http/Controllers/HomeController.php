<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    public function index(){
      $cate_product = DB::table('category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
      $brand_product = DB::table('brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();

      $all_product = DB::table('product')->where('product_status','0')->orderBy('product_id','desc')->limit(6)->get();
      // $all_product =   DB::table('product')
      // ->join('category_product','category_product.category_id','=','product.category_id')
      // ->join('brand','brand.brand_id','=','product.brand_id')
      // ->orderBy('product.product_id','desc')->get();
      return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('product',$all_product);
    }
}
