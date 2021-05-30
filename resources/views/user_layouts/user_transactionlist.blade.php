@extends('user_layouts.user_master')
@section('content')
<!-- <!-- breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Transaction Page</li>
    </ol>
    
    <div style="color:#333333;" class="table-responsive col-md-12 col-lg-12 ">
      <h1 align="center" class=" block none-padding-top" style="margin-top: 90px; margin-bottom: 50px">Daftar Transaksi Produk</h1>

      <table class="table product-table">
          <!-- Table head -->
          <thead>

              <tr>
                  <th class="font-weight-bold">
                  <strong>Status</strong>
                  </th>
  
                  <th class="font-weight-bold text-center">
                  <strong>Biaya Kirim</strong>
                  </th>

                  <th class="font-weight-bold text-center" >
                      <strong style="margin-right: -40px">Produk</strong>
                  </th>
  
                  <th class="font-weight-bold text-center">
                  <strong>Price</strong>
                  </th>
      
                  <th class="font-weight-bold text-center">
                  <strong>Detail</strong>
                  </th> 
  
              </tr>

          </thead>
          
          <tbody>
              
              @foreach ($data_transaksi as $transaksi)

              <tr>
                  <td>
                      <h5 class="mt-3">
                          @if ($transaksi->status=='success')
                          <strong class=" text-uppercase text-green">{{ $transaksi->status }}</strong>
                          @endif
                          @if ($transaksi->status=='expired')
                          <strong class=" text-uppercase text-red">{{ $transaksi->status }}</strong>
                          @endif
                          @if ($transaksi->status=='canceled')
                          <strong class=" text-uppercase text-grey-darkness">{{ $transaksi->status }}</strong>
                          @endif
                          @if ($transaksi->status=='delivered')
                          <strong class=" text-uppercase text-blue">{{ $transaksi->status }}</strong>
                          @endif
                          @if ($transaksi->status=='verified')
                          <strong class=" text-uppercase text-green">{{ $transaksi->status }}</strong>
                          @endif
                          @if ($transaksi->status=='unverified')
                          <strong class=" text-uppercase text-yellow">{{ $transaksi->status }}</strong>
                          @endif
                      </h5>
                  </td>

                  <td>
                      <h5 class="mt-3 text-center">
                          <strong class=" text-uppercase">Rp. {{ number_format($transaksi->shipping_cost) }}</strong>
                      </h5>
                  </td>
                  
                  <td>
                      <h5 class="mt-3">
                          <strong class=" text-uppercase text-center">
                              @foreach ($transaksi->produk as $transaksi_produk)
                              <ol>
                                  <a href="/produk/{{ $transaksi_produk["id"] }}/view">
                                      {{ $transaksi_produk->product_name}}
                                  </a>
                              </ol>    
                              @endforeach
                          </strong>
                      </h5>
                  </td>
                  
                  <td>
                      <h5 class="mt-3 text-center">
                          <strong class=" text-uppercase ">Rp. {{ number_format($transaksi->sub_total) }}</strong>
                      </h5>
                  </td>

                  <td class="text-center">
                      <!-- info btn -->
                      <a href="/statuspemesanan/{{ $transaksi->id}}" class=" btn btn-primary btn-sm">
                          <i class="fas fa-eye">Detail</i>
                      </a>
                  </td>
                  
              </tr>

              @endforeach
          </tbody>
          
      </table>
    <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s" style="margin-bottom: 100px;">
      <a href="/produk"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
    </div>
  
  </div>
</div>
@endsection