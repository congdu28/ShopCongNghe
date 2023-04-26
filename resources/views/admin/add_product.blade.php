@extends('admin_layout')
@section('admin_content')
<div class="row">
    
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           THÊM SẢN PHẨM
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
                                <form role="form" method="post" action="{{URL::to('/save-product')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input required type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả</label>
                                    <textarea style="resize:none" rows="7"  name="product_des" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung Sản Phẩm</label>
                                    <textarea style="resize:none" rows="7"  name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input required type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="">Thuộc Danh Mục</label>
                                    <select name="product_cate" class="form-select" aria-label="Default select example">
                                        @foreach($cate_product as $cate)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Thuộc Thương Hiệu</label>
                                    <select name="product_brand" class="form-select" aria-label="Default select example">
                                        @foreach($brand_product as $brand)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name="product_status" class="form-select" aria-label="Default select example">
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div> 
                                <button type="submit" name="add_product" class="btn btn-info">THÊM</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
 </div>
 @endsection