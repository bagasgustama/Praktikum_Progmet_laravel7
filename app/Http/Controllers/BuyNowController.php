<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carts;
use App\Province;
use App\City;
use App\Couriers;
use Illuminate\Support\Facades\Auth;

class BuyNowController extends Controller
{

    public function cartproduk(){
        $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        return view('user_layouts.user_cardpage_1', compact('data_cart'));
    }

    public function storebuynow(Request $request){
        // dd($request);
        $cart = new Carts();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$request->id_produk;
        $cart->qty=1;
        $cart->status='notyet';
        $cart->save();
        return redirect('/produk/buynow');
    }

    public function buynow(){
        $price=0;
        $total=0;
        $berat_total=0;
        $sub_price=0;

        $data_provinsi = Province::all();
        $data_kota = City::all();
        $data_kurir = Couriers::all();
        $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        foreach ($data_cart as $cart){
            foreach ($cart->produk->diskon as $diskon){
                if(date('Y-m-d')>= $diskon->start && date('Y-m-d')< $diskon->end){
                    $price = $cart->produk->price - ($diskon->percentage/100 * $cart->produk->price);
                    $total += $price * $cart->qty;
                }
            }
            if($price == 0){
                $total += $cart->produk->price * $cart->qty;
            }
            $berat_total = $berat_total + ($cart->produk->weight * $cart->qty);
           
        }
        $sub_price = $total;

        // dd($sub_price);
        // echo($berat_total);

        return view('user_layouts.user_checkoutnow',compact('data_cart','data_provinsi','data_kota','berat_total','data_kurir','sub_price','total'));
    }

    public function hapusbuynow($id){
        $cart = Carts::find($id);
        $cart->delete();
        return redirect('/kategori');
    }
}
