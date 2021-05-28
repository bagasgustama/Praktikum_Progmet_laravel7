@extends('user_layouts.user_master')
@section('content')

<style>.new-collections-grid1:nth-child(2){margin-top: 0px;}</style>
<!-- 
SLIDESHOW
=============================================== -->
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Products</li>
        </ol>
    </div>
</div>


<div class="products">
    <div class="container">
        <div class="col-md-4 products-left">
          @include('user_layouts.user_sidebar')
        </div>
        <div class="col-md-8 products-right">
            {{-- <div class="products-right-grid">
              
            </div> --}}
            <div class="products-right-grids-bottom">
              @foreach ($data_produk as $produkrow)
              <div class="row">
                
                @foreach ($produkrow as $produk)
                    <div class="new-collections-grid1 col-md-4 animated wow slideInUp" data-wow-delay=".5s">
                      <div class="new-collections-grid1-image">
                          <a href="/produk/{{ $produk["id"] }}/view" class="product-image"><img src="images/19.jpg" alt=" " class="img-responsive"></a>
                          <div class="new-collections-grid1-image-pos products-right-grids-pos">
                              {{-- <a href="/produk/{{ $produk["id"] }}/view">View</a> --}}
                          </div>
                          <div class="new-collections-grid1-right products-right-grids-pos-right">
                              <div class="rating">
                                  <div class="rating-left">
                                      <img src="images/2.png" alt=" " class="img-responsive">
                                  </div>
                                  <div class="rating-left">
                                      <img src="images/2.png" alt=" " class="img-responsive">
                                  </div>
                                  <div class="rating-left">
                                      <img src="images/2.png" alt=" " class="img-responsive">
                                  </div>
                                  <div class="rating-left">
                                      <img src="images/1.png" alt=" " class="img-responsive">
                                  </div>
                                  <div class="rating-left">
                                      <img src="images/1.png" alt=" " class="img-responsive">
                                  </div>
                                  <div class="clearfix"> </div>
                              </div>
                          </div>
                      </div>
                      <h4><a href="/produk/{{ $produk["id"] }}/view">{{ $produk["product_name"] }}</a></h4>
                      <p>{{ Str::limit($produk["description"], 30, $end='...') }}</p>
                      <div class="simpleCart_shelfItem products-right-grid1-add-cart">

                        @forelse ($produk->diskon as $diskonbarang)

                        @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                            @php
                            $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                            @endphp

                            <p><i>Rp.{{ number_format($produk["price"]) }}</i><span class="">{{$diskonbarang["percentage"] }}%</span><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]-$nilaidiskon) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                        @else
                            
                            <p><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                        @endif

                    
                    @empty
                       
                        <p><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                    @endforelse

                          {{-- <p><i>Rp.{{ number_format($produk["price"]) }}</i><span class="item_price">Rp.{{ number_format($produk["price"]) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="#">Buy Now </a><a class="item_add" href="#">add to cart </a></p> --}}
                      </div>
                    </div>
                  @endforeach
              </div>
              
              @endforeach
                
                
                <div class="clearfix"> </div>
            </div>
            {{-- <nav class="numbering animated wow slideInRight" data-wow-delay=".5s">
              <ul class="pagination paging">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav> --}}
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //breadcrumbs -->
@endsection