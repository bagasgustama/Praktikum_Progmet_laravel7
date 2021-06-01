@extends('layouts.header1')

@section('content')
    <h3 style="color: white">Dashboard Admin</h3>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <div class="card">
    <h5 class="card-header">Total Transaksi</h5>
    <div class="card-body">
        <h5 class="card-title">@currency($transaksii)</h5>
        {{-- <p class="card-text">Feb 1 - Apr 1, United States</p>
        <p class="card-text text-success">18.2% increase since last month</p> --}}
    </div>
    </div>
    <div class="row my-4">
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Jumlah Transaksi</h5>
            <div class="card-body">
                <h5 class="card-title">{{ $transaksi}}</h5>
                {{-- <p class="card-text">Feb 1 - Apr 1, United States</p>
                <p class="card-text text-success">18.2% increase since last month</p> --}}
            </div>
            </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Jumlah Barang</h5>
            <div class="card-body">
                <h5 class="card-title">{{$barang}}</h5>
                {{-- <p class="card-text">Feb 1 - Apr 1, United States</p>
                <p class="card-text text-success">4.6% increase since last month</p> --}}
            </div>
            </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Jumlah User</h5>
            <div class="card-body">
                <h5 class="card-title">{{$user}}</h5>
                {{-- <p class="card-text">Feb 1 - Apr 1, United States</p>
                <p class="card-text text-danger">2.6% decrease since last month</p> --}}
            </div>
            </div>
    </div>
    <!-- <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Traffic</h5>
            <div class="card-body">
                <h5 class="card-title">64k</h5>
                <p class="card-text">Feb 1 - Apr 1, United States</p>
                <p class="card-text text-success">2.5% increase since last month</p>
            </div>
            </div>
    </div> -->
    <div class="card">
    {{-- <h5 class="card-header">Traffic last 6 months</h5> --}}
    <div class="card-body">
        <div id="traffic-chart"></div>
    </div>
    </div>
    </div>
    {{-- <script>new Chartist.Line('#traffic-chart', {
        labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
        series: [
        [23000, 25000, 19000, 34000, 56000, 64000]
        ]
    }, {
    low: 0,
    showArea: true
    }); 
    </script> --}}
@endsection