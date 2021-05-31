<div class="header">
  <div class="container">
    <div class="header-grid">
      <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
        <ul>
          <ul class="navbar-nav ml-auto">
            
            @guest
                <li class="nav-item">
                  <i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                      <i class="glyphicon glyphicon-book" aria-hidden="true"></i><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                        {{-- <div class="cart box_1">
                          <a href="/cart">
                            <h3> <div class="total">
                              <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
                              <img src="images/bag.png" alt="" />
                            </h3>
                          </a>
                          <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                          <div class="clearfix"> </div>
                        </div> --}}
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('admin-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>


                            </div>
                        @else
                          <div style="margin-left: 20px" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('user.logout') }}"
                                  onclick="event.preventDefault();
                                            document.getElementById('user-logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST"
                                    style="display: none;">
                                  @csrf
                              </form>
                          </div>
                        @endif
                    </li>
            @endguest
          </ul>
        </ul>
      </div>
      <div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">
        {{-- <ul class="social-icons">
          <li><a href="#" class="facebook"></a></li>
          <li><a href="#" class="twitter"></a></li>
          <li><a href="#" class="g"></a></li>
          <li><a href="#" class="instagram"></a></li>
        </ul> --}}
      </div>
      <div class="clearfix"> </div>
    </div>
    <div class="logo-nav">
      <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
        <h1><a href="/">Prak Store <span>Prak anywhere</span></a></h1>
      </div>
      <div class="logo-nav-left1">
        <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header nav_2">
          <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>	
            <!-- Mega Menu -->
            <li class="dropdown active">
            <li><a href="/produk">Products</a></li>	
            @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
            <li><a href="/transaksi">Transaction</a></li>	
            <li><a href="/profile">Profile</a></li>	
            @endif
            <!-- Mega Menu -->
          </ul>
        </div>
        </nav>
      </div>
      <div class="logo-nav-right">
        {{-- <div class="search-box">
          <div id="sb-search" class="sb-search">
            <form>
              <input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">
              <input class="sb-search-submit" type="submit" value="">
              <span class="sb-icon-search"> </span>
            </form>
          </div>
        </div> --}}
          <!-- search-scripts -->
          {{-- <script src="js/classie.js"></script>
          <script src="js/uisearch.js"></script>
            <script>
              new UISearch( document.getElementById( 'sb-search' ) );
            </script> --}}
          <!-- //search-scripts -->
      </div>
      <div class="header-right">
        <div class="cart box_1" style="margin-left: 20px">
          <a href="/cart">
            <h3> <div class="total">
              {{-- <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div> --}}
              <img src="{{asset('images/bag.png')}}" alt="" />
            </h3>
          </a>
          <p><a href="javascript:;" class="simpleCart_empty">Cart</a></p>
          <div class="clearfix"> </div>
        </div>
        @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
        <div class="cart box_1" style="margin-left: 30px">

          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if ($notif->count() != 0)
                    <span class="badge badge-danger badge-counter">
                                
                        <!-- Counter - Alerts -->
                        @if ($notif->count() > 5)
                            {{ $notif->count() }}+
                            
                        @else
                            {{ $notif->count() }}
                            
                        @endif
                    
                        
                    </span>
                @endif
                <p><a href="javascript:;" class="simpleCart_empty">Notif</a></p>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                

                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>

                @foreach ($notif as $item)
                @php
                    $data = json_decode($item->data);
                @endphp
                    
                    <a class="dropdown-item d-flex align-items-center" onclick="" href="">
                      <a class="dropdown-item d-flex align-items-center" >

                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px">
                        <div class="small text-gray-500">{{ $data->nama }} {{ $data->massage}}</div>
                        <span class="font-weight-bold">{{ date("d F Y", strtotime($item->created_at)) }}</span>
                    </div>
                </a>
                @endforeach
{{-- 
                @if ($notif->count() != 0)
                <a class="dropdown-item text-center small text-gray-500" href="/admin/notifikasi">Show All Notification</a>
                    
                @endif --}}
            </div>
        </li>

          {{-- <a href="/cart">
            <h3> <div class="total">
              <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
              <img src="{{asset('images/bag.png')}}" alt="" />
            </h3>
          </a>
          <p><a href="javascript:;" class="simpleCart_empty">Notif</a></p>
          <div class="clearfix"> </div> --}}
        </div>
        @endif
        {{-- <div class="cart box_1">
          <a href="checkout.html">
            <h3> <div class="total">
              <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
              <img src="images/bag.png" alt="" />
            </h3>
          </a>
          <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
          <div class="clearfix"> </div>
        </div>	 --}}
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
<!-- //header -->