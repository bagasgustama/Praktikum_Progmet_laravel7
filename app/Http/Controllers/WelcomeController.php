<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

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
        // $data_produk = Products::all();
        $produk_1 = Products::find(1);
        $produk_2 = Products::find(2);
        $produk_3 = Products::find(3);
        // dd($produk_1);

        return view('welcome', compact('produk_1', 'produk_2', 'produk_3'));
    }
}