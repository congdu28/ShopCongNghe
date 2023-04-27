@extends('admin_layout')
@section('admin_content')
<div class="row">
<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           THÊM MÃ GIẢM GIÁ
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
                                <form role="form" method="post" action="{{URL::to('/insert-coupon-code')}}">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                                    <input type="text" name="coupon_name" class="form-control"  placeholder="Tên MGG">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Code Mã Giảm Giá</label>
                                    <input type="text" name="coupon_code" class="form-control"  placeholder="Ví dụ: ABC62974HNADAC">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="coupon_time" class="form-control"  placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Giảm theo</label>
                                    <select name="coupon_condition" class="form-select" aria-label="Default select example">
                                        <option value="1">Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo số tiền</option>
                                        <option selected value="0">-------------Chọn------------</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phần trăm hoặc Số tiền</label>
                                    <input type="text" name="coupon_number" class="form-control"  placeholder="">
                                </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">THÊM</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
 </div>
 @endsection