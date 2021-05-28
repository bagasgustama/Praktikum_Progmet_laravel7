@extends('user_layouts.user_master')
@section('content')

<div class="container-fluid block bg-grey-lightness">
    <div class="row">
        <div class="container">
            
            <div class="row">
                
                <!-- Asside -->
                <div class="col-md-4 col-lg-3 asside">
                    <!-- Asside nav -->
                    <div class="asside-nav bg-white hidden-xs">
                        <div class="header text-uppercase text-white bg-blue">
                            Category
                        </div>

                        <ul class="nav-vrt bg-white">
                            @foreach ($data_kategori as $listkategori)
                            <li class="active">
                                <a href="/kategori/{{ $listkategori->id }}" class="btn-material">{{ $listkategori->category_name }}</a>
                            </li>
                            @endforeach
                        </ul>

                    </div><!-- / Asside nav -->
                    
                    <!-- List categories for mobile -->
                    <div class="inblock padding-none visible-xs">
                        <div class="mobile-category nav-close">
                            
                            <!-- Header -->
                            <div class="header bg-blue">
                                <span class="head">Category</span>
                                <span class="btn-swither" >
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </div>
                            <ul class="nav-vrt bg-white">
                                @foreach ($data_kategori as $listkategori)
                                <li class="active">
                                    <a href="/kategori/{{ $listkategori->id }}" class="btn-material">{{ $listkategori->category_name }}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
                <!-- ./ Asside -->
                
                <div class="col-md-8 col-lg-9 shop-items-set">

                    
                    {{-- <div class="row pagination-block hidden-xs">
                        <div class="col-xs-12">
                            
                            <div class="wrap">
                                
                                <!-- Pagination -->
                                <ul class="pagination">
                                    <li>
                                        <a href="#">
                                            <span><i class="icofont icofont-rounded-left"></i></span>
                                        </a>
                                    </li>
                                    <li><a href="#">01</a></li>
                                    <li class="active"><a href="#">02</a></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#">04</a></li>
                                    <li><a href="#">05</a></li>
                                    <li>
                                        <a href="#">
                                            <span><i class="icofont icofont-rounded-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Switch style on shop item -->
                                <ul class="swither">
                                    <li class="cols active">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    
                    <!-- Item list -->
                    <div class="row item-wrapper">
                        
                        <!-- Shop item 1 / timer -->

                        @foreach ($data_produk as $produk)

                        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4 shop-item hover-sdw timer"
                        data-timer-date="2018, 2, 5, 0, 0, 0">

                            <div class="wrap">

                                <!-- Image & Caption -->
                                <div class="body">

                                    <!-- Header -->
                                    <div class="comp-header st-4 text-uppercase">

                                        {{ $produk->product_name }} 
                                        {{-- <span>
                                            fake Brand
                                        </span> --}}

                                        <!-- Rate -->
                                        <div class="rate" style="margin: 10px">

                                        @if ($produk->reviewproduk->avg('rate'))

                                            @for ($i = 0; $i < 5; $i++)
                                                @if (floor($produk->reviewproduk->avg('rate')) - $i >= 1)
                                                {{--Full Start--}}
                                                    <i class="fas fa-star text-warning"> </i>
                                                @elseif ($produk->reviewproduk->avg('rate') - $i > 0)
                                                {{--Half Start--}}
                                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                                @else
                                                {{--Empty Start--}}
                                                    <i class="far fa-star text-warning"> </i>
                                                @endif
                                            @endfor
        
        
                                        @else
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
        
                                        @endif

                                        </div>


                                        @foreach ($produk->diskon as $diskonbarang)
                                            @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                                                <span class="sale-badge item-badge text-uppercase bg-red">
                                                    Sale -{{ $diskonbarang->percentage }}%
                                                </span>
                                            @endif
                                        @endforeach

                                    </div>

                                    @php
                                        $foto_counter = 0;
                                    @endphp

                                    @foreach ($produk->productimage as $image)
                                    <!-- Image -->
                                    @php
                                        
                                        $foto_counter++;
                                    @endphp
                                    @if ($foto_counter==1)
                                        <div class="image" style="height: 450px">
                                            <img class="main" src="{{ $image->image }}" alt="">
                                        </div>
                                        
                                    @endif
                                        
                                    @endforeach


                                    <!-- Caption -->
                                    <div class="caption">
                                        <!-- Description -->
                                        <div class="row description">
                                            <div class="col-xs-12">
                                                <h5 class="header">
                                                    Description:
                                                </h5>
                                                
                                                <p>
                                                    {{ Str::limit($produk->description, 30, $end='...') }}
                                                </p>
                                                
                                            </div>
                                        </div>

                                        {{-- <!-- Timer -->
                                        <div class="timer-body">
                                            <span class="sale text-red">Sale</span>
                                            <span class="tdtimer-d"></span>d 
                                            <span class="tdtimer-h"></span>h 
                                            <span class="tdtimer-m"></span>m 
                                            <span class="tdtimer-s"></span>s 
                                        </div> --}}

                                    </div>
                                </div>


                                <!-- Buy btn & more link -->
                                <div class="info">

                                    <!-- Buy btn -->
                                    <a href="/produk/{{ $produk->id }}/tampil" class="btn-material btn-price">
                                        
                                        <!-- Price -->
                                        <span class="price" style="margin-left: -20px">

                                            @forelse ($produk->diskon as $diskonbarang)

                                                @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                                                    @php
                                                    $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                                                    @endphp

                                                    <!-- Sale price -->
                                                    <span class="sale">
                                                        Rp. <span>{{ number_format($produk->price) }}</span>
                                                    </span>

                                                    <!-- Price -->
                                                    <span class="price">
                                                        Rp. {{ number_format($produk->price-$nilaidiskon) }}
                                                    </span>    
                                                @else
                                                    <!-- Price -->
                                                    <span class="price">
                                                        Rp. {{ number_format($produk->price) }}
                                                    </span>
                                                @endif

                                            
                                            @empty
                                                <!-- Price -->
                                                <span class="price">
                                                    Rp. {{ number_format($produk->price) }}
                                                </span>

                                            @endforelse
                                        </span>

                                        {{-- <!-- Price -->
                                        <span class="price">
                                            <!-- Price -->
                                            
                                            <span>
                                                @forelse ($produk->diskon as $diskonbarang)
                                                    @php
                                                     $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                                                    @endphp
                                                    
                                                    <small>
                                                        <strike class="sale" style="font-size: small"> 
                                                            Rp.{{ $produk->price }}
                                                        </strike >
                                                        
                                                    </small>
                                                    <div class="clearfix"></div>
                                                    <span class="price">
                                                        Rp.{{ $produk->price-$nilaidiskon }}
                                                    </span>
                                                @empty
                                                <span class="price">
                                                    Rp.{{ $produk->price }}
                                                </span>
                                                @endforelse --}}


                                                
                                                {{-- @foreach ($produk->diskon as $diskonbarang)
                                                @if (empty($diskonbarang))
                                                    Hai halo
                                                @endif
                                                <strike > 
                                                    
                                                    Rp.{{ $produk->price }}
                                                </strike >
                                                @empty($produk)
                                                    Rp.{{ $produk->price }}
                                                @endempty
                                                
                                                @endforeach 
                                            </span>
                                        </span>--}}

                                        <!-- Icon card -->
                                        <span class="icon-card">
                                            <i class="icofont icofont-cart-alt"></i>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                            
                        @endforeach

                        <!-- / Shop item -->


                        <!-- Paginations -->
                        <div class="row hidden-xs text-center">
                            <div class="col-xs-12">
                                <div class="wrap">
                                    {{ $data_produk->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./ Item list -->
                </div>
            </div>
        </div>
    </div><!-- / Parallax wrapper -->
</div>

@endsection