@extends('layouts.header1')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Transaksi</h1>
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
                            <th>Id Produk</th>
                            <th>Qyt</th>
                            <th>Diskon</th>
                            <th>Selling Price</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <?php $bil=1; ?>
                        @foreach($transactionsdtl as $p)
                        <tr style="text-align: center;">
                            <td>{{$bil++}}</td>
                            <td>{{$p->product_id}}</td>
                            <td>{{$p->qty}}</td>
                            <td>{{$p->discount}}</td>
                            <td>{{$p->selling_price}}</td>
                            {{-- <td>
                            <a class="btn btn-success mr-1" href="{{ route('list.detailtrx', ['id' => $p->id ]) }}"><i class="fas fa-book"></i> Detail</button>
                            <a class="btn btn-warning mr-1" href="{{ route('ubah.transaction.page', ['id' => $p->id ]) }}"><i class="fas fa-edit"></i> Edit Status</button>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection