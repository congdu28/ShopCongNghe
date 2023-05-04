@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
        <div class="panel-heading">
        DANH SÁCH SẢN PHẨM
        </div>
        <?php
                            use Illuminate\Support\Facades\Session;

                            $message = Session::get('message');
                            if($message){
                                echo '<h4 style="color:#34c6eb; margin-top:5px" class="text-center">'.$message.'</h4>' ;
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
                <th style="color:black">Tên</th>
                <!-- <th style="color:black">Mô Tả</th>
                <th style="color:black">Nội Dung</th> -->
                <th style="color:black">Ảnh</th>
                <th style="color:black">Giá</th>
                <th style="color:black">Danh Mục</th>
               
                <th style="color:black">Thương Hiệu</th>
                <th style="color:black">Hiển Thị</th>
                <th style="color:black">Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach($all_product as $product)
            <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td style="color:black">{{$product->product_name}}</td>
                <!-- <td style="color:black"><span class="text-ellipsis">{{$product->product_des}}</span></td>
                <td style="color:black">{{$product->product_content}}</td> -->
                <td ><img src="uploads/products/{{$product->product_image}}" class="img-responsive" height="100" width="120"></img></td>
                <td style="color:black">{{$product->product_price}}</td>
                <td style="color:black"><span class="text-ellipsis">{{$product->category_name}}</span></td>
                <td style="color:black">{{$product->brand_name}}</td>
                <td style="color:black"><span class="text-ellipsis">
                    <?php
                      if($product->product_status == 0){
                    ?>
                        <a href="{{URL::to('/unactive-product/'.$product->product_id)}}">
                              <span style="font-size:28px; color: green" class="fa-thumb-styling fa fa-thumbs-up"></span>
                        </a>
                    <?php
                        }else{ 
                     ?>
                   
                      <a href="{{URL::to('/active-product/'.$product->product_id)}}">
                              <span style="font-size:28px; color:red" class="fa-thumb-styling fa fa-thumbs-down"></span>
                            </a>
                            <?php
                          }
                      ?>
                </span></td>
                <td style="color:black">
                    <a href="{{URL::to('/edit-product/'.$product->product_id)}}"  ui-toggle-class="">
                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                    </a>
                    <span></span>
                    <a href="{{URL::to('/delete-product/'.$product->product_id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')"  ui-toggle-class="">
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