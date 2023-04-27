@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
        <div class="panel-heading">
        DANH SÁCH MÃ GIẢM GIÁ
        </div>
        <?php
                            use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if($message){
                                echo '<h5 style="color:#34c6eb; margin-top:5px" class="text-center">'.$message.'</h5>' ;
                                Session::put('message',null);
                            }
                            ?>
        <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
            </select>
            <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
            </div>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-hover b-t b-light">
            <thead>
            <tr >
                <th style="width:20px;">
                <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                </label>
                </th>
                <th style="color:black">Tên Mã</th>
                <th style="color:black">Mã Code</th>         
                <th style="color:black">Số Lượng</th>
                <th style="color:black">Điều Kiện</th>
                <th style="color:black">Phần trăm / Số tiền</th>
                <th style="color:black">Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($coupon as $cou)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td style="color:black">{{$cou->coupon_name}}</td>
                <td style="color:black"><span class="text-ellipsis">{{$cou->coupon_code}}</span></td>
                <td style="color:black">{{$cou->coupon_time}}</td>
                <td style="color:black"><span class="text-ellipsis">
                    <?php
                      if($cou->coupon_condition == 1){
                    ?>
                       Giảm theo %
                    <?php
                        }else{ 
                     ?>   
                     Giảm theo số tiền
                         <?php
                          }
                      ?>
                </span></td>
                <td style="color:black"><span class="text-ellipsis">
                    <?php
                      if($cou->coupon_condition == 1){
                    ?>
                       Giảm {{$cou->coupon_number}}%
                    <?php
                        }else{ 
                     ?>   
                         Giảm {{$cou->coupon_number}} đ
                         <?php
                          }
                      ?>
                    </span>
                </td>
                <td style="color:black">
                    <a href="{{URL::to('/edit-coupon/'.$cou->coupon_id)}}"  ui-toggle-class="">
                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                    </a>
                    <span></span>
                    <a href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')"  ui-toggle-class="">
                        <i class="fa-solid fa-trash-can fa-lg" style="color: #eb0000;"></i>
                    </a>
                </td>
              </tr>
             @endforeach
          
            </tbody>
        </table>
        </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 10-20 trên 30 danh mục</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>  
    


 @endsection