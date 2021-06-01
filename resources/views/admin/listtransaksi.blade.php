@extends('layouts.header1')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
    </div>
    <div class="section-body">
        <div class="row">
            {{-- <div class="col-lg-12 pb-4">
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahtransaction"><i class="fas fa-plus"></i> Tambah data</button>
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <p>Gagal : </p>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('sukses'))
                <p class="alert alert-success mt-3" style="text-align: center;">{{ Session::get('sukses') }}</p>
                @endif
                @if(Session::has('gagal'))
                <p class="alert alert-danger mt-3" style="text-align: center;">{{ Session::get('gagal') }}</p>
                @endif
            </div> --}}
        </div>
        <div class="row">
            <div class="col-lg-12 table-responsive">
                <table class="table table-striped" id="tabeltransaksi" style="width: 1500px">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Total</th>
                            <th>shipping_cost</th>
                            <th>sub_total</th>
                            <th>user_id</th>
                            <th>courier_id</th>
                            <th>status</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bil=1; ?>
                        @foreach($transactions as $p)
                        <tr style="text-align: center;">
                            <td>{{$bil++}}</td>
                            <td>{{$p->total}}</td>
                            <td>{{$p->shipping_cost}}</td>
                            <td>{{$p->sub_total}}</td>
                            <td>{{$p->user_id}}</td>
                            <td>{{$p->courier_id}}</td>
                            <td>{{$p->status}}</td>
                            <td><a href="./../storage/images/produk/{{$p->image_name}}" target="_blank" style="text-decoration: none; color: #111">{{$p->proof_of_payment}}</a></td>
                            <td>
                                {{-- <a class="btn btn-primary mr-1" href="{{ route('ubah.product.page', ['id' => $p->id ]) }}"><i class="fas fa-edit"></i> Ubah</button> --}}
                                {{-- <a onclick="return confirm('Yakin melanjutkan hapus produk {{$p->product_name}}')" href="{{ route('hapus.product', ['id' => $p->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                {{-- <button class="btn btn-success" onclick="gambarProduk(<?php echo $p->id; ?>)"><i class="fas fa-arrow-up"></i> Upload</button> --}}
                                {{-- <a href="{{ route('listdiskon', ['id' => $p->id]) }}" class="btn btn-info pull-right"><i class="fas fa-dollar-sign"></i> Diskon</a> --}}
                                {{-- <a href="{{ route('listreview', ['id' => $p->id]) }}" class="btn btn-secondary pull-right"><i class="fas fa-list"></i> Review</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection