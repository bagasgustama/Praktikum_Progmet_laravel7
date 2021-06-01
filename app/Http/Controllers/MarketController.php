<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Discounts;
use Illuminate\Http\Request;
use App\Products;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Transactions;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserNotifications;
use App\ProductReview;
use App\Admin;

class MarketController extends Controller
{

  public function viewproduct(){
        $data_kategori = Categories::all();
        $data_produk = Products::all()->chunk(3);
        $hariini = Carbon::now()->setTimezone('GMT+8');
        $tanggal_hariini = Carbon::parse($hariini);
        
        return view('user_layouts.user_product',['data_produk' => $data_produk, 'data_kategori' => $data_kategori, 'tanggal_hariini' => $tanggal_hariini]);

    }

    public function viewdetailproduct (Products $produk){
        
        $data_kategori = Categories::all();
        return view('user_layouts.user_tampil', ['produk'=>$produk, 'data_kategori'=>$data_kategori]);
    }

    public function viewproductkategories($product_categories){
        
        $data_kategori = Categories::all();
        $value = $product_categories;
        $filterkategori = Products::whereHas('kategori', function ($query) use ($value) {
            return $query->where('category_id', '=',  $value);
        })->get();

        return view('user_layouts.user_productkategories',['filterkategori' => $filterkategori, 'data_kategori' => $data_kategori]);
    }

    public function viewprofile(){
        $data_transaksi = Transactions::where('user_id', Auth::user()->id)->get();

        return view('user_layouts.user_profile', compact('data_transaksi'));
    }

    public function editfotoprofile($id){
        $data_user = User::find($id);
        
        return view('user_layouts.user_editprofile', compact('data_user'));
    }

    public function uploadfotoprofile ($id, Request $request){
        $data_user = User::find($id);

        foreach($request->file('foto_user') as $foto){
            
            $nama_image = md5(now().'_').$foto->getClientOriginalName();
            $foto->storeAs('/public/app/img/fotoprofilepengguna',$nama_image);

            $data_user = User::find($id);
            $data_user->profile_image = $nama_image;
            $data_user->save();

        }

        return redirect('/profile');
    }

    public function tampiltransaksi(){
        $data_transaksi = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('user_layouts.user_transactionlist', compact('data_transaksi'));
    }

    public function tambahreview(Request $request){
        $products = $request->all();
        $products ['user_id'] = Auth::user()->id;
        ProductReview::create($products);
        
        return redirect('/');

    }




}










    // public function readNotifUser($id)
    // {
    //     $notif = UserNotifications::find($id);
    //     $notif->read_at = NOW();
    //     $notif->save();
 
    //     return response()->json(['code' => 200]);
    // }

    // public function tampilnotifikasi(){
    //     $data_usernotofikassi = UserNotifications::where('notifiable_id', Auth::user()->id)->where('read_at', null)->orderBy('created_at','desc')->get();
    //     // $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

    //     return view('/user_layouts/user_notifikasi', compact('data_usernotofikassi'));
    // }

