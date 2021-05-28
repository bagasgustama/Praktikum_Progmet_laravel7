<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminNotifications;
use App\Carts;
use App\Transactions;
use App\TransactionsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\Province;
use App\Couriers;
use App\Products;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Carbon\Carbon;
use App\User;

class CheckoutController extends Controller
{
    public function checkoutproduk(){
        $price=0;
        $total=0;
        $berat_total=0;
        $sub_price=0;

        $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();
        $data_provinsi = Province::all();
        $data_kota = City::all();
        $data_kurir = Couriers::all();


        foreach ($data_cart as $cart){
            foreach ($cart->produk->diskon as $diskon){
                if(date('Y-m-d')>= $diskon->start && date('Y-m-d')< $diskon->end){
                    $price = $cart->produk->price - ($diskon->percentage/100 * $cart->produk->price);
                    $total += $price * $cart->qty;
                }
                // $sub_price = $total;
            }
            if($price == 0){
                $total += $cart->produk->price * $cart->qty;
            }
            $berat_total = $berat_total + ($cart->produk->weight * $cart->qty);
        }

        // return view('user_layouts.user_checkout', compact('data_cart','berat_total','data_kurir','total'));
        return view('user_layouts.user_checkout', compact('data_cart','data_provinsi','data_kota','berat_total','data_kurir','total'));
    }

    public function cekongkir(Request $request){
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 114, // ID kota/kabupaten asal
            'destination'   => $request->kota, // ID kota/kabupaten tujuan
            'weight'        => $request->berat, // berat barang dalam gram
            'courier'       => $request->kurir // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }

    public function store(Request $request){
        $price=0;
        $total=0;

        $data_cart= Carts::where('user_id', Auth::user()->id)->where('status', 'notyet')->get();

        foreach ($data_cart as $cart){
            foreach ($cart->produk->diskon as $diskon){
                if(date('Y-m-d')>= $diskon->start && date('Y-m-d')< $diskon->end){
                    $price = $cart->produk->price - ($diskon->percentage/100 * $cart->produk->price);
                    $total += $price * $cart->qty;
                }
                // $sub_price = $total;
            }
            if($price == 0){
                $total += $cart->produk->price * $cart->qty;
            }
        }
        $transaksi = new Transactions;
        $date_time = strtotime('+1 day');
        $tanggal_besok = date('Y-m-d H:i:s',$date_time);
        $transactions = $request->all();
        $transactions['timeout'] = $tanggal_besok;

        // return ($tanggal_besok);

        $transactions['total'] = $request->shipping_cost + $total;
        $transactions['sub_total'] = $total;
        $transactions['user_id'] = Auth::user()->id;
        $transactions['status'] = 'unverified';
        $id_transaksi = $transaksi->create($transactions);

        // dd($id_transaksi->user_id);
        // dd($request);

        foreach($data_cart as $key=>$value){
            TransactionsDetail::create([
                'transaction_id' => $id_transaksi->id,
                'product_id' => $value->product_id,
                'qty' => $value->qty,
                // 'discount' => $value->qty,
                // aslinya
                'discount' => $request->discount[$key],
        

                // 'selling_price'=> $value->qty
                // aslinya
                'selling_price'=> $request->selling_price[$key]
            ]);
            
            Carts::where('user_id', Auth::user()->id)->update([
                'status' => 'checkedout',
            ]);

            // --Buat saat barang di checkout maka stock barang akan di kurangi dengan qty--
            // Products::where('product_id' == $value->product_id )->update([
            //     'stock' => $value->stock - $value->qty,
            // ]);

        }

        $admin = Admin::find(5);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Telah melakukan transaksi',
            'id'=>$id_transaksi->id
        ];

        $data_encode = json_encode($data);
//********************************************* */
        // $admin->createNotif($data_encode);


        $user = User::find($id_transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Transaksi anda sedang diproses',
            'id'=>$id_transaksi->id
        ];
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        // Products::where('user_id', Auth::user()->id)->update([
        //     'stock' => 'checkedout',
        // ]);

        // dd($id_transaksi->id);
        return redirect('/upload-bukti/'.$id_transaksi->id);
    }

    public function konfirmasiproduk($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);

        // $data_transaksi = Transactions::find($id);
        $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');

        $date = Carbon::parse($today);
        $tanggal_hariini = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $tanggal = $data_transaksi->timeout;

        $batas_waktu = $data_transaksi->timeout;

        // dd($tanggal);
        $selisih_waktu = Carbon::parse($tanggal)->diff($today,false);
        $sec = $selisih_waktu->s;
        $menit = $selisih_waktu->i;
        $jam = $selisih_waktu->h;
        $deadline = $jam.':'.$menit.':'.$sec;

        // $tanggal_parse = Carbon::parse($tanggal_hariini);
        // $tanggal_hariini_menit = Carbon::parse($tanggal_hariini);

        $tanggal_hariini = Carbon::parse($hariini);
        $end_date = Carbon::parse($batas_waktu);

        // $waktu_sekarang = $tanggal_hariini.$today;
        // $hasildiff = Carbon::parse($tanggal)->diff($today,false);
        // return( $menit);
        // return($tanggal);
        // dd($data_transaksi->status);

        if($data_transaksi->status == 'unverified'){

            if($tanggal_hariini >= $end_date){
                $data_transaksi->status = 'expired';
                $data_transaksi->save();
                // return ('Gagal Bayar');
                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Transaksi anda telah kadarluarsa',
                    'id'=>$data_transaksi->id
                ];
        
                // dd($data);
        
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }
        }


        // else {
        //     return ('Yuuk Bayar');
        // }

        // return($data_transaksi);
        
        return view('user_layouts.user_upload', compact('deadline','data_transaksi'));
    }

    public function cancelproduk($id){
        $data_transaksi = Transactions::find($id);
        // $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        // $date = Carbon::parse($today);
        $data_transaksi->status = 'canceled';
        $data_transaksi->save();

        $user = User::find($data_transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'pembatalan transaksi anda berhasil',
            'id'=>$data_transaksi->id
        ];
        
        // dd($user);
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        $admin = Admin::find(5);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Telah membatalkan pesanan',
            'id'=>$data_transaksi->id
        ];

        $data_encode = json_encode($data);

        // $admin->createNotif($data_encode);

        return redirect('/produk');
    }

    public function uploadpembayaran($id, Request $request){

        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);

        foreach($request->file('foto_pembayaran') as $foto){
            // dd($data_transaksi->produk->pluck('id'));

            $nama_image = md5(now().'_').$foto->getClientOriginalName();
            $foto->storeAs('img/buktipembayaran',$nama_image);
            // $files[] = [
            //     'proof_of_payment' => $nama_image,
            //     'updated_at' => now()
            // ];

            $data_transaksi = Transactions::find($id);
            $data_transaksi->proof_of_payment = $nama_image;
            // $data_transaksi->status = 'verified';
            $data_transaksi->save();
            // Transactions::where($id, Auth::user()->id)->update([
            //     'proof_of_payment' => $nama_image,
            //     'updated_at' => now()
            // ]);

            // foreach ($request->pinjam_buku as $databuku ){
            
            //     $data_buku=  Buku::where('id', $databuku)->get()->first();
                
            //     $data_pinjam = 1;
            //     $total = $data_buku->jumlah - $data_pinjam;
    
            //     $buku = Buku::where('id', $data_buku->id)->update([
            //         'jumlah' =>$total
            //     ]);
    
            //     // $total ->update($total->all());
            //     // if($buku){
            //     //     return ('berhasil');
    
            //     // }else{
            //     //     return('gagal');
            //     // }
    
            // }

        }
        // foreach($data_transaksi->detail_transaksi as $transaksi){
        //     // --Buat saat barang di checkout maka stock barang akan di kurangi dengan qty--
        //     $stock_barang = $data_transaksi->produk[0]->stock;
        //     $jumlah_beli = $data_transaksi->detail_transaksi[0]->qty;
        //     // $w = $stock_barang - $jumlah_beli;

        //     // dd($w);

        //     Products::where('id', $transaksi->product_id )->update([
        //         'stock' => $stock_barang - $jumlah_beli
        //     ]);
        // }

        return redirect('/sukses-bayar/'.$data_transaksi->id);
    }

    public function suksesbayar($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);

        // $data_transaksi = Transactions::find($id);
        // $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        $tambahlimamenit = $data_transaksi->updated_at->addMinutes(5)->toTimeString();
        // $newDateTime = Carbon::now()->setTimezone('GMT+8')->addMinutes(25)->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');
        
        $tanggal_hariini = Carbon::parse($hariini);
        $waktu_kirim = Carbon::parse($tambahlimamenit);
        // dd($waktu_kirim);

        if($data_transaksi->status == 'verified'){
            if($tanggal_hariini >= $waktu_kirim){
                $data_transaksi->status = 'delivered';
                $data_transaksi->save();
                // return ('Barang terkirim');

                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Barang pesanan sedang dalam perjalanan',
                    'id'=>$data_transaksi->id
                ];
                
                // dd($user);
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }

        }

        

        // return($data_transaksi->status);
        
        return view('user_layouts.user_suksesbayar', compact('data_transaksi'));
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