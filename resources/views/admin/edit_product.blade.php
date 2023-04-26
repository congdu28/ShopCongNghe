@extends('admin_layout')
@section('admin_content')
<div class="row">
    
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           CẬP NHẬT SẢN PHẨM
                        </header>
                        <?php
                            use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if($message){
                                echo '<h5 style="color:#34c6eb; margin-top:5px" class="text-center">'.$message.'</h5>' ;
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($edit_product as $product)
                                <form role="form" method="post" action="{{URL::to('/update-product/'.$product->product_id)}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả</label>
                                    <textarea style="resize:none" rows="7"  name="product_des" class="form-control" value="">{{$product->product_des}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung Sản Phẩm</label>
                                    <textarea style="resize:none" rows="7"  name="product_content" class="form-control" value="">{{$product->product_content}}</textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh</label>
                                    <input type="file" name="product_image" class="form-control">
                                    <img src="{{URL::to('uploads/products/'.$product->product_image)}}" class="img-responsive" height="100" width="120"></img>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name="product_price" class="form-control" value="{{$product->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Thuộc Danh Mục</label>
                                    <select name="product_cate" class="form-select" aria-label="Default select example">
                                       @foreach($cate_product as $cate)
                                            @if($cate->category_id==$product->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Thuộc Thương Hiệu</label>
                                    <select name="product_brand" class="form-select" aria-label="Default select example">
                                        @foreach($brand_product as $brand)
                                            @if($cate->category_id==$product->category_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name="product_status" class="form-select" aria-label="Default select example">
                                        <!-- hay bị nhầm  -->
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </div> 
                                <button type="submit" name="update_product" class="btn btn-info">CẬP NHẬT</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>
            </div>
 </div>
 @endsection