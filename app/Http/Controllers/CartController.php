<?php

namespace App\Http\Controllers;

use App\Carts;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartproduk(){
        
        $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        // dd($data_cart);

        return view('user_layouts.user_cart', compact('data_cart'));
    }

    public function store(Request $request){
        // dd($request);
        $cart = new Carts();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$request->id_produk;
        $cart->qty=1;
        $cart->status='notyet';
        $cart->save();
        return redirect('/cart');
    }

    public function hapuscart($id){
        $cart = Carts::find($id);
        $cart->delete();
        return redirect('/cart');
    }

    public function addqty($id){
        $cart = Carts::find($id);
        if($cart->qty >= $cart -> produk -> stock){
            return response()->json(['status'=>0]);
        }else{
            $cart->qty = $cart->qty+1;
            $cart->save();

            $diskonbarang = $cart->produk->getdiskon();
            if(isset($diskonbarang)){
                $nilaidiskon = ($cart->produk->price-(($diskonbarang->percentage/ 100)* $cart->produk->price))*$cart->qty;
            }else{
                $nilaidiskon = $cart->qty* $cart->produk->price;
            }
            
            return response()->json(['status'=>1,'qty'=>$cart->qty, 'nilaidiskon'=>number_format($nilaidiskon)]);
        }
    }

    public function minusqty($id){
        $cart = Carts::find($id);
        if($cart->qty <= 1){
            return response()->json(['status'=>0]);
        }else{
            $cart->qty = $cart->qty-1;
            $cart->save();
    
            $diskonbarang = $cart->produk->getdiskon();
            if(isset($diskonbarang)){
                $nilaidiskon = ($cart->produk->price-(($diskonbarang->percentage/ 100)* $cart->produk->price))*$cart->qty;
            }else{
                $nilaidiskon = $cart->qty* $cart->produk->price;
            }
            
            return response()->json(['status'=>1,'qty'=>$cart->qty, 'nilaidiskon'=>number_format($nilaidiskon)]);
        }
    }

}
