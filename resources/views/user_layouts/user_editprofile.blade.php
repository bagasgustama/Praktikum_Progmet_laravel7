@extends('user_layouts.user_master')
@section('content')
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Edit Profile Page</li>
    </ol>
    <h1 style="margin-top: 100px; margin-bottom:30px; font-weight:bold;">Tambah Foto</h1>
    <form action="/profile/uploadfoto/{{$data_user->id}}" method="POST"  enctype="multipart/form-data">
      <div class="">
          <div class="form-group ">
              <input type="file" class="form-control" placeholder="Enter your promocode" name="foto_user[]" required accept="image/*">
          </div>
      </div>
      <span class="btn-panel col-md-2">
              @csrf
              <button type="submit" class="sdw-wrap btn-primary">
                  <a  class="sdw-hover btn btn btn-material btn-primary ">
                      {{-- <i class="icon icofont icofont-check-circled"></i> --}}
                      <span class="body" >Submit</span></a>

              </button> 
      </span>
  </form>
  </div>
</div>
@endsection