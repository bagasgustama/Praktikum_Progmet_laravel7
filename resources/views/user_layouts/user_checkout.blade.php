@extends('user_layouts.user_master')
@section('content')
<!-- <!-- breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Checkout Page</li>
    </ol>
  </div>
</div>
<!-- //breadcrumbs -->
<!-- checkout -->
<div class="checkout">
  <div class="container">
    {{-- <h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains: <span>{{$data_cart->count()}} Product</span></h3> --}}
    <h1 class="header text-uppercase">
      Recepient Address 

  </h1>
    <div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
      <form action="/checkout-produk" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" style="padding: 0px; margin-top :20px;">Address</label>
            <input type="text" class="form-control" id="alamat_user" name="address" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1" style="padding: 0px; margin-top :20px;">Province</label>
        </div>
        <select class=" form-control" style="padding: 0px " aria-label="Default select example" id="provinsi_user" name="province">
            <option selected disabled>--PILIH--</option>
            @foreach ($data_provinsi as $daftar_provinsi)
                <option data-provinsi="{{ $daftar_provinsi->province_id }}" value="{{$daftar_provinsi->name}}">{{ $daftar_provinsi->name }}</option>
            @endforeach
        </select>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1" style="padding: 0px; margin-top :20px;">City</label>
        </div>
        <select class=" form-control" style="padding: 0px " aria-label="Default select example" id="kota_user" name="regency">
            <option selected disabled>--PILIH--</option>
            @foreach ($data_kota as $daftar_kota)
                <option data-kota="{{ $daftar_kota->city_id }}" value="{{$daftar_kota->name}}">{{ $daftar_kota->name }}</option>
            @endforeach
        </select>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="exampleCheck1" style="padding: 0px; margin-top :20px;">Courier</label>
        </div>
        <select class=" form-control" style="padding: 0px margin-bottom :20px;" aria-label="Default select example" id="pilihan_kurir" name="courier_id">
            <option selected>--PILIH--</option>
            @foreach ($data_kurir as $daftar_kurir)
                <option data-kurir="{{ $daftar_kurir->code }}" value="{{ $daftar_kurir->id }}">{{ $daftar_kurir->courier}}</option>
            @endforeach
        </select>
        <div class="mb-3 form-check">
          <label class="form-check-label" for="exampleCheck1" style="padding: 0px; margin-top :20px;">Layanan</label>
        </div>
        {{-- <select class=" form-control" style="padding: 0px " name="shipping_cost" id="layanan">
            <option value="" selected disabled>Pilih Layanan</option>
        </select> --}}
        <select class=" form-control" style="padding: 0px " name="shipping_cost" id="layanan" required>
          <option value="" selected disabled>Pilih Layanan</option>
      </select>
        <button type="submit" class="btn btn-primary " style="margin-top :20px;">Submit</button>
    
      
    </div>
    <div class="checkout-left">	
      <div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
        <h4>List Order</h4>
        <ul class="list-2">
          
      </ul>
        <ul>
          <li>Total <i>-</i> <span>Rp.{{ number_format($total) }} </span></li>
          <li>Total Weight <i>-</i> <span id="berat_total" data-berat="{{ $berat_total }}" class="sub">
            {{ number_format($berat_total) }} gram
        </span>
          {{-- <li>Product3 <i>-</i> <span>$299.00 </span></li> --}}
          {{-- <li>Total Service Charges <i>-</i> <span>$15.00</span></li>
          <li>Total <i>-</i> <span>$854.00</span></li> --}}
        </ul>
      </div>
      {{-- <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
        <a href="single.html"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
      </div> --}}
      <div class="clearfix"> </div>
    </div>
    @foreach ($data_cart as $cart)

    <tr>
        @php
            $image = $cart->produk->getfirstimage();
        @endphp
        <th scope="row">
          {{-- ******************************* --}}
            {{-- <img style="height:50px;" src="{{ $image->image }}" alt="" class="img-fluid z-depth-0"> --}}
        </th>

        <td>
            {{-- <h5 class="mt-3">
                <strong>{{ $cart->produk->product_name }}</strong>
            </h5> --}}
        </td>

        @forelse ($cart->produk->diskon as $diskonbarang)

        @php
        $nilaidiskon = ($diskonbarang->percentage / 100)* $cart->produk->price
        @endphp

        @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
            {{-- <td>Rp
                <span class="float-lef grey-text price0">
                    {{ number_format(($cart->produk->price-$nilaidiskon)*$cart->qty) }}
                </span> --}}
                <input type="hidden" name="discount[]" value="{{ $diskonbarang->percentage }}">
                <input type="hidden" name="selling_price[]" value="{{ ($cart->produk->price-$nilaidiskon)*$cart->qty ?? '0' }}">
            </td>
            
        @else
            <td>
                {{-- <span class="float-lef grey-text price0">
                    {{ number_format(($cart->produk->price)*$cart->qty) }}
                </span> --}}
                <input type="hidden" name="discount[]" value="0">
                <input type="hidden" name="selling_price[]" value="{{ ($cart->produk->price)*$cart->qty ?? '0' }}">
            </td>
        @endif


        @empty
        <td>
            {{-- <span class="float-lef grey-text price0">
                {{ number_format(($cart->produk->price)*$cart->qty) }}
            </span> --}}
            <input type="hidden" name="discount[]" value="0">
            <input type="hidden" name="selling_price[]" value="{{ ($cart->produk->price)*$cart->qty ?? '0' }}">
        </td>

        @endforelse

        <td class="text-center text-md-left">
            {{-- <p class="text-danger" style="display:none" id="notif0"></p>
            <span class="qty0">{{ number_format($cart->qty) }}</span> --}}
        </td>    
    </tr>

    @endforeach
  </form>
  </div>
{{-- **** --}}

</div>
<!-- //checkout -->

@endsection

@section('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    jQuery(document).ready(function() {       
        jQuery.ajaxSetup({        
            headers: {            
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
            }    
        });    
    });

    $('#pilihan_kurir').on('change', function() {
        
        var kurir =$('#pilihan_kurir').find('option:selected').data("kurir");
        var kota = $('#kota_user').find('option:selected').data("kota");
        var berat = $('#berat_total').data('berat');
        var html_option = '';
        console.log(kurir);
        console.log(kota);
        console.log(berat);
        $.ajax({
            url: '/produk/cekongkir',
            type: 'post',
            data: {
                kurir: kurir,
                kota: kota,
                berat: berat
                },
            success:function(data){
                $('select[name="shipping_cost"]').html('<option value="" selected>Tidak ada layanan</option>');
            
                // looping data result nya
                $.each(data, function(key, value){
                    // looping data layanan misal jne reg, jne oke, jne yes
                    $.each(value.costs, function(key1, value1){
                        // untuk looping cost nya masing masing
                        $.each(value1.cost, function(key2, value2){
                            html_option +='<option value="'+ value2.value +'">' + value1.service + '-' + value1.description + '- Rp.' +value2.value+ '</option>';
                            $('select[name="shipping_cost"]').html( html_option);
                        });

                        loadSubOngkir();
                        loadtotals();
                    });
                });
            }
        });
    });

    

</script>
@endsection