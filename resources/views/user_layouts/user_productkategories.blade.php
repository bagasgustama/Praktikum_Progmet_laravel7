@extends('user_layouts.user_master')
@section('content')

<style>.new-collections-grid1:nth-child(2){margin-top: 0px;}</style>

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
            <div class="products-right-grids-bottom">
              @foreach ($filterkategori as $produk)
              <div class="row">
                
                    <div class="new-collections-grid1 col-md-4 animated wow slideInUp" data-wow-delay=".5s">
                      <div class="new-collections-grid1-image">
                          <a href="/produk/{{ $produk->id }}/view" class="product-image">
                            @php
                                $count = 0;
                            @endphp

                            @foreach ($produk->productimage as $image)
                            <!-- Image -->
                            @php
                              $count++;
                            @endphp
                            @if ($count==1)
                                <div style="height: 250px" >
                                  {{-- <img src="{{asset('images/11.jpg')}}" alt=" "  class="img-responsive center"></a> --}}
                                  <img src="{{ $image["image"] }}" alt=" "  class="img-responsive center"></a>
                                </div>

                                {{-- <div class="image" style="height: 450px">
                                    <img class="main" src="{{ $image->image }}" alt="">
                                </div> --}}
                                
                            @endif
                                
                            @endforeach
                            {{-- <img src="{{asset('images/19.jpg')}}" alt=" " class="img-responsive"></a> --}}
                          <div class="new-collections-grid1-image-pos products-right-grids-pos">
                          </div>
                          
                      </div>
                      <h4 style="margin-top: 50px"><a href="/produk/{{ $produk->id }}/view">{{ $produk->product_name }}</a></h4>
                      <p>{{ Str::limit($produk->description, 30, $end='...') }}</p>
                      <div class="simpleCart_shelfItem products-right-grid1-add-cart">
                        @forelse ($produk->diskon as $diskonbarang)

                        @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                            @php
                            $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                            @endphp
                            <div class="rating1">
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
                            <p><i>Rp.{{ number_format($produk["price"]) }}</i><span class="">{{$diskonbarang["percentage"] }}%</span><span class="item_price"style="font-weight: bold">Rp.{{ number_format($produk["price"]-$nilaidiskon) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                        @else
                        <div class="rating1">
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
                            <p><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                        @endif

                    @empty
                    <div class="rating1">
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
                        <p><span class="item_price" style="font-weight: bold">Rp.{{ number_format($produk["price"]) }}</span><a class="item_add" style="backgroud-color:red; color:red;" href="/produk/{{ $produk["id"] }}/view">View Product</a></p>

                    @endforelse
                      </div>
                    </div>
              </div>
              
              @endforeach
                
                
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection