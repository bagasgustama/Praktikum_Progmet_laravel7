@extends('user_layouts.user_master')
@section('content')
<!-- breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Order Status Page</li>
    </ol>
    @if ($data_transaksi->status == 'delivered')
    <h1 style="margin-top: 100px; margin-bottom:30px; font-weight:bold;">Pembayaran Sukses</h1>
    <h2 style="margin-bottom:100px;">Pesanan Sedang Dikirim</h2>
    <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s" style="margin-bottom: 100px;">
      <a href="/produk"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
    </div>
    @endif
    @if ($data_transaksi->status == 'success')
    <h1 style="margin-top: 100px; margin-bottom:30px; font-weight:bold;">Pesanan Sudah Berhasil</h1>
    <h2 style="margin-bottom:100px;">Rating dan Ulasan</h2>
      <!-- Form -->
      <div class="add-comment row">
          <form class="form-horizontal" method="POST" action="/review">
              @csrf
              <div class="form-group text-center">
                  <div class="col-sm-10">
                      <select name="product_id" class="form-control" id="exampleFormControlSelect1" style="padding: 0px ">
                          <option selected disabled>Pilih Produk</option>
                          @foreach ($data_transaksi->produk as $produk)
                              
                              <option value="{{ $produk->id }}">{{ $produk->product_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-sm-10" style="margin-top: 20px">
                      <select name="rate" class="form-control" id="exampleFormControlSelect1" style="padding: 0px ">
                          <option selected disabled>Rating</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                      </select>
                    </div>
                  <div class="col-sm-10" style="margin-top: 20px">
                      <textarea name="content" class="form-control" id="inputcomment" cols="30" rows="2"></textarea>
                  </div>
              </div>
              <div class="form-group-ml-3" >
                  <button type="submit" class="btn btn-success btn-material">
                      <span class="body">Beri Ulasan</span>
                      <i class="icon icofont icofont-check-circled"></i>
                  </button>
              </div>
          </form>
          <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s" style="margin-bottom: 100px;">
            <a href="/produk"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
          </div>
      </div>
      
  @endif

  </div>
</div>
@endsection