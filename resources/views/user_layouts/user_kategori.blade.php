@extends('user_layouts.user_master')
@section('content')

<div class="container-fluid block bg-grey-lightness">
    <div class="row">
        <div class="container">
            
            <div class="row">
                <div class="col-md-4 col-lg-3 asside">
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

                    </div>
                    
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
                
                <div class="col-md-8 col-lg-9 shop-items-set">
                    <div class="row item-wrapper">
                        
                        @foreach ($data_produk as $produk)

                        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-4 shop-item hover-sdw timer"
                        data-timer-date="2018, 2, 5, 0, 0, 0">
                            <div class="wrap">
                                <div class="body">

                                    <!-- Header -->
                                    <div class="comp-header st-4 text-uppercase">

                                        {{ $produk->product_name }} 

                                        <div class="rate" style="margin: 10px">

                                        @if ($produk->reviewproduk->avg('rate'))

                                            @for ($i = 0; $i < 5; $i++)
                                                @if (floor($produk->reviewproduk->avg('rate')) - $i >= 1)
                                                    <i class="fas fa-star text-warning"> </i>
                                                @elseif ($produk->reviewproduk->avg('rate') - $i > 0)
                                                    <i class="fas fa-star-half-alt text-warning"> </i>
                                                @else
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

                                    <div class="caption">
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
                                    </div>
                                </div>

                                <div class="info">

                                    <a href="/produk/{{ $produk->id }}/tampil" class="btn-material btn-price">
                                        
                                        <span class="price" style="margin-left: -20px">

                                            @forelse ($produk->diskon as $diskonbarang)

                                                @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                                                    @php
                                                    $nilaidiskon = ($diskonbarang->percentage / 100)* $produk->price
                                                    @endphp

                                                    <span class="sale">
                                                        Rp. <span>{{ number_format($produk->price) }}</span>
                                                    </span>
                                                    
                                                    <span class="price">
                                                        Rp. {{ number_format($produk->price-$nilaidiskon) }}
                                                    </span>    
                                                @else
                                                
                                                    <span class="price">
                                                        Rp. {{ number_format($produk->price) }}
                                                    </span>
                                                @endif

                                            
                                            @empty
                                            
                                                <span class="price">
                                                    Rp. {{ number_format($produk->price) }}
                                                </span>

                                            @endforelse
                                        </span>

                                        <span class="icon-card">
                                            <i class="icofont icofont-cart-alt"></i>
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                            
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection