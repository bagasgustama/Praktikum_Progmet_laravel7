<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discounts;
use App\Products;
use Carbon\Carbon;

class DiscountsController extends Controller
{
    public function index(){
        $data_diskon = Discounts::all();
        foreach ($data_diskon as $diskon){
            $hariini = Carbon::now()->setTimezone('GMT+8');
            $batas_waktu = $diskon->end;
     
            $tanggal_hariini = Carbon::parse($hariini);
            $end_date = Carbon::parse($batas_waktu);
            if($tanggal_hariini > $end_date){
                $diskon = Discounts::find($diskon->id);
                $diskon->delete();
             }
        }

        return view ('admin_layouts.discounts.admin_diskon',['data_diskon'=> $data_diskon]);
    }

    public function buatdiskon(){
        $dataproduk = Products::all();
        return view ('admin_layouts.discounts.admin_tambahdiskon', compact('dataproduk'));
    }

    public function viewdiskon(Discounts $discounts, $id){
        $data_diskon = Discounts::find($id);

        // $databarang = $data_diskon->diskon->pluck('product_name')->toArray();
        // dd($data_diskon);

        return view ('admin_layouts.discounts.admin_viewdiskon',['data_diskon'=> $data_diskon]);
    }

    public function creatediskon(Request $request){
        // $tomorow = Carbon::now()->setTimezone('GMT+8')->tomorrow(5)->toDateString();
        // $tanggal_mulai = $request->start;
        // // dd($request->start);

        // $besok = Carbon::parse($tomorow);
        // $end_date = Carbon::parse($tanggal_mulai);

        // if($besok > $end_date){
        //     // return ('Gak boleh gitu');
        //     return redirect('/admin/diskon/buat')->with('sukses','Start diskon baru tidak boleh kurang dari besok');
        // }

        // return ('Yaa boleh gitu');

        $this->validate($request,[
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        
        // dd($request);
        $diskon = Discounts::create($request->all());
        // $diskon -> produk()->attach(request('id_product'));
        return redirect('/admin/diskon')->with('sukses','Diskon baru berhasil di tambahkan');
    }

    public function editdiskon(Discounts $discounts, $id){
        $data_produk = Products::all();
        $data_diskon = Discounts::find($id);

        // dd($data_diskon->produk);

        return view('admin_layouts.discounts.admin_editdiskon',['data_diskon'=> $data_diskon ], compact('data_produk'));
    }

    public function updatediskon(Request $request, $id){
        // dd($request->percentage);
        $diskon = Discounts::find($id);
        $diskon ->update($request->all());
        return redirect('/admin/diskon')->with('sukses','Data diskon telah diperbaharui');
    }

    public function hapusdiskon($id){
        $diskon = Discounts::find($id);
        $diskon->delete();
        return redirect ('/admin/diskon')->with('sukses','Data diskon berhasil dihapus');
    }
}
