@extends('layout')
<!-- lấy phân layout -->
@section('content')
<!-- đặt tên content cho phần content web để bên trang chủ lấy content -->
              <div class="features_items"><!--features_items-->
						
			           @foreach($brand_name as $brand_by_name)
							<h2 class="title text-center">THƯƠNG HIỆU {{$brand_by_name->brand_name}}</h2>
						@endforeach

						@foreach($brand_by_id as $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
											<img src="{{URL::to('uploads/products/'.$product->product_image)}}" alt="" />
											<h4 style="color:orange">{{number_format($product->product_price)}} VNĐ</h4>
											<p style="font-size: large;">{{$product->product_name}}</p>
										</a>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
									</div>
								
									<img src="{{asset('frontend/images/new.png')}}" class="new" alt="" />
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>			
						@endforeach		
				</div><!--features_items-->
					
		
					
				<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center"> Đề xuất</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/recommend3.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{asset('frontend/images/recommend1.jpg')}}" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
												
											</div>
										</div>
									</div>
								
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