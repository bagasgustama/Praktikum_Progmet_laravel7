@extends('user_layouts.user_master')
@section('content')
<!-- <!-- breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Upload Payment Page</li>
    </ol>
  </div>
</div>
<div class="checkout">
  <div class="container">
    <h1 class="header text-uppercase">
      Upload Bukti Pembayaran 

    </h1>
    <div class="list-body">   
      <div class="profile-main text-center">
          @if ($data_transaksi->status == 'canceled' || $data_transaksi->status == 'expired' || $data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered'  || $data_transaksi->status == 'success' )
              @if ($data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered'  || $data_transaksi->status == 'success' )
              <h1 class="text-uppercase text-blue" style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                  Pembayaran Berhasil
              </h1>

              @else
              <h1 class="text-uppercase text-blue" style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                  Pembayaran gagal
              </h1>
              @endif
          @else
              <h1 class="text-uppercase text-blue" style="font-weight: bolder; padding-bottom: 70px; font-size: 100px">
                  {{ $deadline }}
              </h1>
          @endif
      </div>
    </div>
    @if ($data_transaksi->status == 'canceled' || $data_transaksi->status == 'expired' || $data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered'  || $data_transaksi->status == 'success' )
      @if ($data_transaksi->status == 'verified' || $data_transaksi->status == 'delivered' || $data_transaksi->status == 'success' )
      <span class="btn-panel col-md-4" >
          <form action="/kategori">
              <button type="submit" class="sdw-wrap btn-primary">
                  <a  class="sdw-hover btn btn btn-material btn-view" style="color: white"><i class="icon icofont icofont-check-circled"></i><span class="body" >Kembali ke halaman utama</span></a>

              </button> 
          </form>
      </span>
      <span class="btn-panel col-md-4" >
          <div class="form-group">
              <button type="submit" class="sdw-wrap btn-success">
                  <a  href="/produk/sukses-bayar/{{ $data_transaksi->id }}" class="sdw-hover btn btn btn-material btn-success" style="color: white"><i class="icon icofont icofont-vehicle-delivery-van"></i><span class="body" >Tracking Barang</span></a>

              </button> 
          </div>
      </span>

      @else
      <span class="btn-panel col-md-4" >
          <form action="/kategori">
              <button type="submit" class="sdw-wrap btn-primary">
                  <a  class="sdw-hover btn btn btn-material btn-view" style="color: white"><i class="icon icofont icofont-check-circled"></i><span class="body" >Kembali ke halaman utama</span></a>

              </button> 
          </form>
      </span>
      @endif
      @else

        <form action="/uploadpembayaran/{{$data_transaksi->id}}" method="POST"  enctype="multipart/form-data">
            <div class="">
                <div class="form-group ">
                  <label for="">Pilih Foto</label>
                    <input type="file" class="form-control" placeholder="Enter your promocode" name="foto_pembayaran[]" required accept="image/*">
                </div>
            </div>
            <span class="btn-panel col-md-2">
                    @csrf
                    <button type="submit" class="sdw-wrap btn-primary" >
                        <a  class="sdw-hover btn btn btn-material btn-primary">
                            {{-- <i class="icon icofont icofont-check-circled"></i> --}}
                            <span class="body" >Submit</span></a>

                    </button> 
            </span>
        </form>

        <span class="btn-panel text-left">
            <form action="/produk/cancel/{{$data_transaksi->id}}" method="POST">
                @csrf
                <button class="sdw-wrap btn-danger" >
                    <a  class="sdw-hover btn btn btn-material btn-danger">
                        {{-- <i class="icon icofont icofont-close-circled"></i> --}}
                        <span class="body">canceled</span></a>

                </button> 
            </form>
        </span>
            
        @endif
  </div>
</div>
@endsection