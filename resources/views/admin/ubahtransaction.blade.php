@extends('layouts.header1')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Status Transaction</h1>
    </div>
    <div class="section-body card" style="padding: 20px;">
        <div class="row">
            <div class="col-lg-12 pb-4">
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
            </div>
        </div> 
        <form class="row" action="{{ route('save.transaction', ['id' => $id ]) }}" method="post">
            @csrf
        
            <div class="col-lg-6"> 
                <select class="form-control" name="status" required>
                        <option value="">--Status--</option>
                        {{-- @foreach($transactions as $t) --}}
                        <option value="unverified">unverified</option>
                        <option value="verified">verified</option>
                        <option value="delivered">delivered</option>
                        <option value="success">success</option>
                        {{-- @endforeach --}}
                    </select>
                </div>
                <div class="form-group pt-4" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
        
    </div>
</section>
@endsection