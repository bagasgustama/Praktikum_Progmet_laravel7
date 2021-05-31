@extends('user_layouts.user_master')
@section('content')
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Product View Page</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->

<div class="single">
	<div class="container">
		
		<div class="col-md-12 single-right">
			<div class="col-md-5 single-right-left animated wow slideInUp" data-wow-delay=".5s">
				<div class="flexslider">
					<ul class="slides">
						@foreach ($produk->productimage as $produk_detail)
						<li data-thumb="{{ $produk_detail->image }}">
							<div class="thumb-image"> <img src="{{ $produk_detail->image }}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						@endforeach

						{{-- <li data-thumb="images/si1.jpg">
							 <div class="thumb-image"> <img src="images/si1.jpg" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<li data-thumb="images/si2.jpg">
							 <div class="thumb-image"> <img src="images/si2.jpg" data-imagezoom="true" class="img-responsive"> </div>
						</li>  --}}
					</ul>
				</div>
				<!-- flixslider -->
					<script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
					<link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />
					<script>
					// Can also be used with $(document).ready()
					$(document).ready(function() {
						$('.flexslider').flexslider({
						animation: "slide",
						controlNav: "thumbnails"
						});
					});
					</script>
				<!-- flixslider -->
				
				
				{{-- <div class="col-sm-4 col-md-5 fix-height">
						<div class="owl-carousel image image-nav">
						@foreach ($produk->productimage as $produk_detail)
						<a class="product-image"><img src="{{ $produk_detail->image }}" alt=" " class="img-responsive"></a>
						{{-- <a class="product-image"><img src="{{asset('images/19.jpg')}}" alt=" " class="img-responsive"></a> --}}
						{{-- @endforeach --}}
					{{-- </div> --}}
			{{-- </div> --}}
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight" data-wow-delay=".5s">
				<h3>{{ $produk->product_name}}</h3>

				@forelse ($produk->diskon as $diskonbarang)

				@if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
						@php
						$nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
						@endphp

							<h5 class="mt-4" style="margin-top: 20px;"><i>Rp.{{ number_format($produk["price"]) }}</i></h5><h5><span class="item_price"> Disc {{$diskonbarang["percentage"] }}%</span></h5>
							<h4><span class="" style="font-weight: bold">Rp.{{ number_format($produk["price"]-$nilaidiskon) }}</span></h4>

				@else
						
						<h4><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span></h4>

				@endif

		
		@empty
			 
				<h4><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span></h4>

		@endforelse

				<div class="rating1">
					<div class="description">
					<h5 ><i>Rating</i></h5>
					<span class="starRating" style="height: 23px">

						@if ($produk->reviewproduk->avg('rate'))
        
							@for ($i = 0; $i < 5; $i++)
									@if (floor($produk->reviewproduk->avg('rate')) - $i >= 1)
									<img src="{{asset('images/2.png')}}" data-imagezoom="true" >
									@elseif ($produk->reviewproduk->avg('rate') - $i > 0)
									<img src="{{asset('images/2.png')}}" data-imagezoom="true" >
									@else
									<img src="{{asset('images/1.png')}}" data-imagezoom="true" >
									@endif
							@endfor

						@else
							@for ($i = 0; $i < 5; $i++)
							<img src="{{asset('images/1.png')}}" data-imagezoom="true" >

							@endfor

						@endif
					</span>
				</div>
				</div>
				<div class="description">
					<h5><i>Description</i></h5>
					<p>{{ $produk["description"]}}</p>
				</div>
				<div class="description">
					<h5 class="mt-4"><i>Stok</i></h5>
					<p>{{ $produk["stock"]}}</p>
					<h5 class="mt-4"><i>Weight</i></h5>
					<p>{{ $produk["weight"]}} gram</p>
				</div>
				
				<div class="occasion-cart">
					<form action="/produk/store/buynow" method="POST">
						@csrf
						<div style="margin-bottom: 20px"><span>Qty</a></span>
						<div style="margin-top: 5px;margin-bottom: 20px">
							<input type="text" value="1" name="qtynow" style="width: 30px"></div>
						<input type="hidden" value="{{ $produk->id }}" name="id_produk">
						<button class="text-blue" style="width: 150px; padding-right: 41px" type="submit">Buy Now</button>
					</form>
					<form action="/cart/store" method="POST">
						@csrf
						<input type="hidden" value="{{ $produk->id }}" name="id_produk">
						<button class="text-blue" style="width: 150px; padding-right: 41px; margin-top:20px;" type="submit">Add to cart</button>
					</form>
				</div>
			</div>
			<div class="clearfix"> </div>
		
		</div>
		<div class="clearfix"> </div>
		<div class="row shop-item-info">
			<div class="col-xs-12">
					
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
							<li role="presentation">
									<a class="text-uppercase">Review Product
									</a>
							</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
							<div role="tabpanel" class="comments" id="comments">
									
									<!-- Header -->
									<h3 class="header"></h3>

									<!-- Comments -->
									<ul class="media-list">

											<!-- 1 comments -->
											@foreach ($produk->reviewproduk as $review)
											<li class="media">
													<div class="media-left">
															<a href="#">
																	<img class="media-object" src="{{ $review->user->image }}" alt="..." width="70px" height="70px">
															</a>
													</div>
													<div class="media-body">
															<h3 class="media-heading" style="font-weight: bold">
																	<a>{{ $review->user->name }}</a>
															</h3>
															<h4>
																{{$review->content}}
															</h4>

															<div><span class="media-info" style="font-size: 12px; margin-top: 10px">{{ date("d F Y", strtotime($review->created_at)) }}</span></div>

															{{-- Balasan --}}
															@foreach ($review->response as $respon_admin)
															<div class="media">
																	<div class="media-left">
																			<a href="#">
																					<img class="media-object" src="{{ $respon_admin->admin->image }}" alt="...">
																			</a>
																	</div>
																	<div class="media-body">
																			<h4 class="media-heading">
																					<a href="#">{{ $respon_admin->admin->name }}</a>
																			</h4>
																			{{ $respon_admin->content }}

																			<span class="media-info">{{ date("d F Y", strtotime($respon_admin->created_at)) }}</span>

																	</div>
															</div>
																	
															@endforeach

													</div>
											</li>
													
											@endforeach

									</ul>

							
							</div>
					</div>
			</div>
	</div>
	<!-- END: COMMENTS -->
</div>
	</div>
</div>
<!-- //single -->
<script src="{{asset('js/imagezoom.js')}}"></script>

@endsection