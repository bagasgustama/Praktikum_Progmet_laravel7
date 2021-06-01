<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use App\Notifications\AdminResetPasswordNotification;
use App\Categories;
use App\Discounts;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Transactions;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserNotifications;
use App\ProductReview;
use App\Admin;
class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // asda
        $data_kategori = Categories::all();
        $data_produk = Products::all();
        $value = 1;
        $filterkategori = Products::whereHas('kategori', function ($query) use ($value) {
            return $query->where('category_id', '=',  $value);
        })->get();
        
        $hariini = Carbon::now()->setTimezone('GMT+8');
        $tanggal_hariini = Carbon::parse($hariini);
        // return view('user_layouts.user_product',['data_produk' => $data_produk, 'data_kategori' => $data_kategori, 'tanggal_hariini' => $tanggal_hariini]);

        $user = User::find(1);
        User::find(1)->notify(new AdminResetPasswordNotification);

        return view('welcome',['data_produk' => $data_produk ,'filterkategori' => $filterkategori, 'data_kategori' => $data_kategori, 'tanggal_hariini' => $tanggal_hariini]);
    
        // return view('welcome');
    }
}