@extends('user_layouts.user_master')
@section('content')

<!-- breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
      <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
      <li class="active">Cart Page</li>
    </ol>
  </div>
</div>
<!-- //breadcrumbs -->

<div class="checkout">
  <div class="container">
    <h3 class="animated wow slideInLeft" data-wow-delay=".5s">Your shopping cart contains: <span>{{$data_cart->count()}} Product</span></h3>
    <div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
      
      @if ($data_cart->count()==0)
        <h2 class="text-uppercase text-blue" style="font-weight: bolder">
          Tidak Terdapat Barang di dalam Cart
        </h2>
          
      @else
        <table class="timetable_sub">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Product Name</th>
              <th>Price/Qty</th>
              <th>Total Price</th>
              <th>Remove</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($data_cart as $cart)
              <tr class="rem1">

                <td class="invert-image"><a href="single.html"><img src="images/22.jpg" alt=" " class="img-responsive" /></a>
                </td>

                <td class="invert">
                  <div class="quantity"> 
                    <div class="quantity-select">           
                      
                      <div id="dec{{ $cart->id }}" class=" entry value-minus">
                        <span type="button" onclick="minusQty('{{ $cart->id }}')">
                            <i class="icofont icofont-caret-down"></i>
                        </span>
                      </div>
                      
                      @forelse ($cart->produk->diskon as $diskonbarang)
                      
                      <a><input type="text" class="incdec input-qty input-text" style="width: 40px; height: 30px""
                      name="qty[]" id="qty{{$cart->id}}" value="{{$cart->qty}}"/></a>
                      
                      @empty
                      
                      <a><input type="text" class="incdec input-qty input-text" style="width: 40px; height: 30px"
                      name="qty[]" id="qty{{$cart->id}}" value="{{$cart->qty}}"/></a>
                      
                      @endforelse
                      
                      <div id="inc{{ $cart->id }}" class=" entry value-plus active">
                        <span type="button" onclick="addQty('{{ $cart->id }}')">
                            <i class="icofont icofont-caret-up"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </td>

                <td class="invert">{{ $cart->produk->product_name }}
                </td>

                <td class="invert">
                  
                  @foreach ($cart->produk->diskon as $diskonbarang)
                    @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                    @endif
                  @endforeach
        
                  @forelse ($cart->produk->diskon as $diskonbarang)
            
                  @php
                      $nilaidiskon = ($diskonbarang->percentage / 100)* $cart->produk->price
                  @endphp
            
                  @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                      <span class="price">
                          <span class="prc" >
                              <i>Rp.</i>
                              <span name="price">{{ number_format($cart->produk->price-$nilaidiskon) }}</span>
                          </span>
                      </span>
                  @else
                      <span class="price">
                          <span class="prc" >
                              <i>Rp.</i>
                              <span name="price">{{ number_format($cart->produk->price) }}</span>
                          </span>
                      </span>
                  @endif
              
                  @empty
                  <span class="price">
                      <span class="prc" >
                          <i>Rp.</i>
                          <span name="price">{{ number_format($cart->produk->price) }}</span>
                      </span>
                  </span>
            
                  @endforelse
                </td>

                <td class="invert">
                  @forelse ($cart->produk->diskon as $diskonbarang)
                    @if (date('Y-m-d')>= $diskonbarang->start && date('Y-m-d')< $diskonbarang->end)
                        <i>Rp.</i>
                        <span id="hargadiskon{{ $cart->id }}" class="total">
                            {{ number_format(($cart->produk->price-$nilaidiskon)*$cart->qty) }}
                        </span>
                        
                    @else
                        <i>Rp.</i>
                        <span id="hargadiskon{{ $cart->id }}" class="total">
                            {{ number_format(($cart->produk->price)*$cart->qty) }}
                        </span>
                        
                    @endif

                    @empty
                        <i>Rp.</i>
                        <span id="harga{{ $cart->id }}" name="price" class="total">
                            {{ number_format(($cart->produk->price)*$cart->qty) }}
                        </span>

                  @endforelse
                </td>

                <td class="invert">
                  
                  <div class="rem">
                    {{-- <div class="close1">  --}}
                      <form action="/produk/cart/{{ $cart->id }}/deletecart" method="post">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin hapus data ini?')">Remove
                                <i class="icofont icofont-close-line"></i>
                            </button>
                      </form>
                    {{-- </div> --}}
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div style="margin-top: 30px" class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
          <a href="/checkout"><h4>Continue to checkout</h4></a>
        </div>
      @endif
    </div>
    <div class="checkout-left">	
      <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
        <a href="/produk"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
      </div>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
@endsection

@section('after-script')
<script>

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    incrementVar = 0;

    $('.inc.button').click(function(){
        var cart_id = $(this).attr('id').substring(3);
        // console.log(cart_id);
        var max = $(this).data("max");
            var $this = $(this),
            $input = $this.next('input'),
            $parent = $input.closest('div'),
            newValue = parseInt($input.val())+1;
        $parent.find('.inc').addClass('a'+newValue);
        $input.val(newValue);
        price = $(this).next('input').data('price'); 
        incrementVar += newValue;
        total = price * newValue;
        console.log(newValue);
        $(`#hargadiskon${cart_id}`).html(formatRupiah(total.toString()));
        $(`#harga${cart_id}`).html(formatRupiah(total.toString()));
    });

    $('.dec.button').click(function(){
        var cart_id = $(this).attr('id').substring(3);
        // console.log(cart_id);

        var min = $(this).data("min");
            var $this = $(this),
            $input = $this.prev('input'),
            $parent = $input.closest('div'),
            newValue = parseInt($input.val());
        $parent.find('.dec').addClass('a'-newValue);

        if (newValue <= 1) {
            price = $(this).prev('input').data('price');
            total = price * 1;
            console.log(price);

            $(`#hargadiskon${cart_id}`).html(formatRupiah(price.toString()));
            $(`#harga${cart_id}`).html(formatRupiah(price.toString()));
        } else {
            $input.val(newValue-1);
            price = $(this).prev('input').data('price');
            total = price * (newValue-1);

            $(`#hargadiskon${cart_id}`).html(formatRupiah(total.toString()));
            $(`#harga${cart_id}`).html(formatRupiah(total.toString()));
        }

    });
    
    jQuery(document).ready(function() {       
        jQuery.ajaxSetup({        
            headers: {            
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')        
            }    
        });    
    });

    function addQty(id){
      var url = '/produk/addqty/'+id;
      // console.log(url);
        $.ajax({
            url:url,
            method : 'POST',
            success: function(response) {
              // console.log('a');
                if(response.status == 0){
                    alert('Stock barang habis');
                }else{
                    $('#qty'+id).val(response.qty);
                    $('#hargadiskon'+id).html(response.nilaidiskon);
                    $('#harga'+id).html(response.nilaidiskon);
                }
            }
        });
    }

    function minusQty(id){
        var url = '/produk/minusqty/'+id;
        $.ajax({
            url:url,
            method : 'POST',
            success: function(response) {
                if(response.status == 0){
                    alert('Kuantitas barang tidak boleh 0');
                    
                }else{
                    $('#qty'+id).val(response.qty);
                    $('#hargadiskon'+id).html(response.nilaidiskon);
                    $('#harga'+id).html(response.nilaidiskon);
                }
            }
        });
    }

    $('.value-plus').on('click', function(){
      var cart_id = $(this).attr('id').substring(3);
      var qty = parseInt($(`#qty${cart_id}`).val());
      qty += 1;
      $(`#qty${cart_id}`).val(qty);
      console.log(qty);
      var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
      divUpd.text(newVal);
      addQty(cart_id);
    });

    $('.value-minus').on('click', function(){
      var cart_id = $(this).attr('id').substring(3);
      var qty = parseInt($(`#qty${cart_id}`).val());
      qty -= 1;
      $(`#qty${cart_id}`).val(qty);
      console.log(qty);
      var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
      if(newVal>=1) divUpd.text(newVal);
      minusQty(cart_id);
    });
</script>
    
@endsection