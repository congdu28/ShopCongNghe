@extends('layout')
<!-- lấy phân layout -->
@section('content')
<!-- đặt tên content cho phần content web để bên trang chủ lấy content -->

@foreach($detail_product as $detail_pro)
<div class="product-details">
    <!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('uploads/products/'.$detail_pro->product_image)}}" class="img-responsive" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">

								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{asset('uploads/products/'.$detail_pro->product_image)}}" height="70" width="60"  alt=""></a>
										  <a href=""><img src="{{asset('uploads/products/'.$detail_pro->product_image)}}" height="70" width="60"  alt=""></a>
										  <a href=""><img src="{{asset('uploads/products/'.$detail_pro->product_image)}}" height="70" width="60"  alt=""></a>
										  <a href=""><img src="{{asset('uploads/products/'.$detail_pro->product_image)}}" height="70" width="60"  alt=""></a>
										</div>
										
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$detail_pro->product_name}}</h2>
								<p>Pro ID: 1089772</p>
								<img src="images/product-details/rating.png" alt="" />
								<form action="{{URL::to('/save-cart')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
								<span>
									<span>{{number_format($detail_pro->product_price)}} VNĐ</span>
									<label>Số lượng còn: 233</label>
									<input type="number" name="quantity" min="1" value="1" style="width: 80px; " />
									<input type="hidden" name="productid_hidden" value="{{$detail_pro->product_id}}" />
									<button type="submit" class="btn btn-fefault cart" >
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button>
								</span>
								</form>
								<p><b>Kho:</b> Còn hàng</p>
								<p><b>Tình trạng:</b> Mới 100%</p>
								<p><b>Thương hiệu:</b> {{$detail_pro->brand_name}} </p>
								<p><b>Danh mục:</b> {{$detail_pro->category_name}} </p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Giới thiệu</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Thông Tin Chi tiết</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh Giá (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$detail_pro->product_content!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
							<p>{!!$detail_pro->product_des!!}</p>
							</div>
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach					

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản Phẩm Liên Quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								@foreach($related_product as $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
										<div class="single-products">
									<div class="productinfo text-center">
										<a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}">
											<img src="{{URL::to('uploads/products/'.$lienquan->product_image)}}" alt="" />
											<h4 style="color:orange">{{number_format($lienquan->product_price)}} VNĐ</h4>
											<p style="font-size: large;">{{$lienquan->product_name}}</p>
										</a>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
									</div>
								
									<img src="{{asset('frontend/images/new.png')}}" class="new" alt="" />
								</div>
										</div>
									</div>
								@endforeach		
								</div>

								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->

@endsection