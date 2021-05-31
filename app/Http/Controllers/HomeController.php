<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductImages;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pic()
    {
        return view('user_layouts.addpic');
    }

    public function uploadpic(Request $request){
        $produk = 1;
        // $request = 1;
        $files = [];
        // dd($request->file('pilih_foto'));
        dd($request);

        foreach($request->file('pilih_foto') as $foto){
            dd($foto);
            if($foto->isValid()){
                $nama_image = md5(now().'_').$foto->getClientOriginalName();
                $foto->storeAs('/public/app/img/gambarproduk',$nama_image);
                $files[] = [
                    'product_id' => $produk->id,
                    'image_name' => $nama_image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

            }
        }
        dd($files);
        ProductImages::insert($files);
        return redirect('/addpic');
    }
}