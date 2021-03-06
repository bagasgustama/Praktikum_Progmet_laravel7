@extends('user_layouts.user_master')
@section('content')

<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Profile Page</li>
    </ol>
    <h1 class="header text-uppercase" style="margin-top: 60px">
      Profil Pengguna
    
    </h1>
    @if (Auth::user()->profile_image != null)
    <div class="image">
        <img src="{{ Auth::user()->image }}" class="" width="170px" height="170px" >
    </div>
    @else
    <div class="form-group" style="margin-top: 100px">
          
          <!-- info btn -->
          <a href="/edit_profile/{{Auth::user()->id}}" class=" btn btn-yellow btn-sm">
              <i class="">Edit Foto Profile</i>
          </a>
    </div>
    @endif
    <h1 style="margin-top: 20px; margin-bottom:30px; font-weight:bold;">{{ Auth::user()->name }}</h1>
    <h2 style="margin-bottom:100px;">{{ Auth::user()->email }}</h2>
    <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s" style="margin-bottom: 100px;">
      <a href="/produk"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
    </div>
  
  </div>
</div>
@endsection