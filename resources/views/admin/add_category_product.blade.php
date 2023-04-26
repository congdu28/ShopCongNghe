@extends('admin_layout')
@section('admin_content')
<div class="row">
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           THÊM DANH MỤC SẢN PHẨM
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
                                <form role="form" method="post" action="{{URL::to('/save-category-product')}}">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả</label>
                                    <textarea style="resize:none" rows="7"  name="category_des" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name="category_status" class="form-select" aria-label="Default select example">
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div> 
                                <button type="submit" class="btn btn-info">THÊM</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
 </div>
 @endsection