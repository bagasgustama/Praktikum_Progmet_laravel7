<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Product_categorie;
use App\Models\Product_category_detail;
use App\Models\Product_image;
use App\Models\Product_review;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $transaksi = DB::table('transactions')->count();
        $transaksii = DB::table('transactions')->sum('total');
        $barang = DB::table('products')->count();
        $user = DB::table('users')->count();
        $data['category'] = Product_categorie::all();
        return view('admin.homepage',['transaksi'=>$transaksi, 'category'=>$data['category'], 'transaksii'=>$transaksii, 'barang'=>$barang, 'user'=>$user]);

        // $data['category'] = Product_categorie::all();
    	// return view('admin.homepage', $data);
        // return view('admin');
    }
}