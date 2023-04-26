@extends('admin_layout')
@section('admin_content')
<div class="row">
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           CẬP NHẬT THƯƠNG HIỆU SẢN PHẨM
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
                            @foreach($edit_brand_product as $edit_brand)
                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/update-brand-product/'.$edit_brand->brand_id)}}">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" value="{{$edit_brand->brand_name}}" name="brand_name" class="form-control" placeholder="Tên Danh Mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả</label>
                                    <textarea style="resize:none" value="" rows="7"  name="brand_des" class="form-control">{{$edit_brand->brand_des}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng Thái</label>
                                    <select name="brand_status" class="form-select" aria-label="Default select example">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div> 
                                <button type="submit" name="update_brand_product" class="btn btn-info">CẬP NHẬT</button>
                            </form>
                            </div>
                              @endforeach
                        </div>
                    </section>
            </div>
 </div>
 @endsection