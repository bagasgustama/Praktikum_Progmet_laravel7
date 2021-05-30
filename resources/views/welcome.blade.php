@extends('user_layouts.user_master')
@section('content')

<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            {{-- <li class="active">Products</li> --}}
        </ol>
    </div>
</div>

<!-- banner -->
<div class="banner">
    <div class="container">
        <div class="banner-info animated wow zoomIn" data-wow-delay=".5s">
            <h3 style=" font-weight: bold">Prak Online Shopping</h3>
            <h4 style="">Up to <span>50% <i>Off/-</i></span></h4>
            <div class="wmuSlider example1">
                <div class="wmuSliderWrapper">
                    @foreach ($data_produk as $produk)
                    @forelse ($produk->diskon as $diskonbarang)
                    @if ( date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                        @php
                        $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                        @endphp
                    
                        <article style="position: absolute; width: 100%; opacity: 0;"> 
                            <div class="banner-wrap">
                                <div class="banner-info1">
                                    <div class="new-collections-grid1-image">
                                        <div class="footer-grids">
                                            <div class="col-md-9 footer-grid animated wow slideInLeft" data-wow-delay=".5s">
                                                <div>
                                                    <h3 style="text-decoration: line-through; margin-bottom: 0px">Rp.{{ number_format($produk["price"]) }}</h3>
                                                </div>
                                                <div>
                                                    <h1 style="text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
                                                    font-size: 100px;font-weight: bold; color:rgb(251, 255, 0);">{{$diskonbarang["percentage"] }}%</h1>
                                                </div>
                                                <div>
                                                    <h2 style="text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
                                                    font-size: 100px;font-weight: bold; color: white">Rp.{{ number_format($produk["price"]-$nilaidiskon) }}</h2>

                                                </div>
                                                <div>
                                                    <a class="item_add" style="font-size: 50px;backgroud-color:red; color:rgb(255, 255, 255);" href="/produk/{{ $produk["id"] }}/view">View Product</a>

                                                </div>

                      
                                            </div>
                                            <div class="col-md-3 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
                                                <a href="/produk/{{ $produk->id }}/view" class="product-image"><img src="images/19.jpg" alt=" " class="img-responsive"></a>
                                                <div class="new-collections-grid1-image-pos products-right-grids-pos">
                                                    {{-- <a href="/produk/{{ $produk["id"] }}/view">View</a> --}}
                                                </div>
                                            </div>
                                            <div class="clearfix"> </div>
                                          </div>
                                    </div>
                                    
                                    {{-- <p style="">Kategori Pakaian</p> --}}
                                </div>
                            </div>
                        </article>
                    @else

                    @endif
                    @empty
                    @endforelse
                    @endforeach
                </div>
            </div>
                <script src="js/jquery.wmuSlider.js"></script> 
                <script>
                    $('.example1').wmuSlider();         
                </script> 
        </div>
    </div>
</div>
<!-- //banner -->
@endsection