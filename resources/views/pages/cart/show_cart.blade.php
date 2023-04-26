@extends('layout')
<!-- lấy phân layout -->
@section('content')
<!-- đặt tên content cho phần content web để bên trang chủ lấy content -->
<section id="cart_items" class="">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			@if(session()->has('message'))
			 <div class="alert alert-success text-center" style="font-weight: bold; font-size: large;">
				{{session()->get('message')}}
			 </div>
			@elseif(session()->has('error'))
			 <div class="alert alert-danger text-center" style="font-weight: bold;">
				{{session()->get('message')}}
			 </div>
			@endif
			<form action="{{URL('/update-cart-quantity')}}" method="POST">
				@csrf
				<table class="table table-considered table-responsive">
					<thead>
						<tr class="cart_menu">
							<td class="image" style="font-weight: bold;">Hình Ảnh</td>
							<td class="description" style="font-weight: bold;">Tên</td>
							<td class="price" style="font-weight: bold;">Giá</td>
							<td class="quantity" style="font-weight: bold;">Số lượng</td>
							<td class="total" style="font-weight: bold;">Tổng Tiền</td>
							<td style="font-weight: bold;">Xóa</td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')== true)
					    @php
								$total = 0;
						@endphp
						@foreach(Session::get('cart') as $cart)
							@php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total+=$subtotal;
							@endphp

						<tr>
							<td class="cart_product">
								<img src="{{asset('uploads/products/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
							</td>
							<td class="cart_description">
								<h4>{{$cart['product_name']}}</h4>
							</td>
							<td class="cart_price">
								<h4 >{{number_format($cart['product_price'],0,',','.')}}đ</h4>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">				
									<input class="cart_quantity_" style="height: 30px; width: 50px;" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
								</div>
							</td>
							<td class="cart_total">
								<h4 class="cart_total_price">
									{{number_format($subtotal,0,',','.')}}đ
									
								</h4>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-cart-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
						   <td>
					      	 	<input type="submit" value="Cập Nhật" name="update_qty" class="btn btn-default update">
                           </td>
						   <td>
						     	<a class="btn btn-default update" href="{{url('/delete-all-cart')}}">Xóa Hết Giỏ Hàng</a>
						   </td>
					    </tr>
						<tr>
						   <td>
								<ul>
									<li style="color:black">Tổng sổ tiền sản phẩm: <span style="color:black; font-weight: bold;">{{number_format($total,0,',','.')}} đ</span></li>
									<li style="color:black">Thuế (VAT): <span style="color:black;font-weight: bold;">5000 đ</span></li>
									<li style="color:black">Phí vận chuyển: <span style="color:black; font-weight: bold;">Miễn phí</span></li>
									<li style="color:black">Tổng số tiền thanh toán: <span style="color:black; font-weight: bold;">$61</span></li>
								</ul>	
								
						   </td>
						   <td><a class="btn btn-default update" href="">Tính mã giảm giá</a>
								<a class="btn btn-default update" href="">Thanh Toán Ngay</a></td>
						</tr>
					   @else
					    <tr>
								@php
                                  echo '<h3 style="text-align: center;">Giỏ Hàng Của Bạn Đang Trống</h3>';
								@endphp
						</tr>
						 @endif
					</tbody>
					
					</form>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->




@endsection