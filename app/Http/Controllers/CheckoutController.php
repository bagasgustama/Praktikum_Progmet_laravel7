<?php

namespace App\Http\Controllers;
use App\Notifications\AdminResetPasswordNotification;
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

        return view('user_layouts.user_checkout', compact('data_cart','data_provinsi','data_kota','berat_total','data_kurir','total'));
    }

    public function storecheckout(Request $request){
        $price=0;
        $total=0;

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
        }
        $transaksi = new Transactions;
        $date_time = strtotime('+1 day');
        $tanggal_besok = date('Y-m-d H:i:s',$date_time);
        $transactions = $request->all();
        $transactions['timeout'] = $tanggal_besok;

        $transactions['total'] = $request->shipping_cost + $total;
        $transactions['sub_total'] = $total;
        $transactions['user_id'] = Auth::user()->id;
        $transactions['status'] = 'unverified';
        $id_transaksi = $transaksi->create($transactions);

        foreach($data_cart as $key=>$value){
            TransactionsDetail::create([
                'transaction_id' => $id_transaksi->id,
                'product_id' => $value->product_id,
                'qty' => $value->qty,
                'discount' => $request->discount[$key],
                'selling_price'=> $request->selling_price[$key]
            ]);
            
            Carts::where('user_id', Auth::user()->id)->update([
                'status' => 'checkedout',
            ]);

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
        
        return redirect('/upload-bukti/'.$id_transaksi->id);
    }

    public function cekongkir(Request $request){
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 114, 
            'destination'   => $request->kota, 
            'weight'        => $request->berat, 
            'courier'       => $request->kurir 
        ])->get();

        return response()->json($cost);
    }

    public function confirmproduct($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);
        $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');

        $date = Carbon::parse($today);
        $tanggal_hariini = Carbon::now()->setTimezone('GMT+8')->toDateString();
        $tanggal = $data_transaksi->timeout;

        $batas_waktu = $data_transaksi->timeout;

        $selisih_waktu = Carbon::parse($tanggal)->diff($today,false);
        $sec = $selisih_waktu->s;
        $menit = $selisih_waktu->i;
        $jam = $selisih_waktu->h;
        $deadline = $jam.':'.$menit.':'.$sec;

        $tanggal_hariini = Carbon::parse($hariini);
        $end_date = Carbon::parse($batas_waktu);

        if($data_transaksi->status == 'unverified'){

            if($tanggal_hariini >= $end_date){
                $data_transaksi->status = 'expired';
                $data_transaksi->save();
                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Transaksi anda telah kadarluarsa',
                    'id'=>$data_transaksi->id
                ];
        
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }
        }
        
        return view('user_layouts.user_upload', compact('deadline','data_transaksi'));
    }
    
    public function uploadpayment($id, Request $request){

        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);
    

        foreach($request->file('foto_pembayaran') as $foto){
            $nama_image = md5(now().'_').$foto->getClientOriginalName();
            $foto->storeAs('img/buktipembayaran',$nama_image);
            $data_transaksi = Transactions::find($id);
            $data_transaksi->proof_of_payment = $nama_image;
            $data_transaksi->save();
        }
        User::find(Auth::user()->id)->notify(new AdminResetPasswordNotification);
        return redirect('/sukses-bayar/'.$data_transaksi->id);
    }
    
    public function successpayment($id){
        $data_transaksi= Transactions::where('user_id', Auth::user()->id)->find($id);
        $tambahlimamenit = $data_transaksi->updated_at->addMinutes(5)->toTimeString();
        $hariini = Carbon::now()->setTimezone('GMT+8');
        $tanggal_hariini = Carbon::parse($hariini);
        $waktu_kirim = Carbon::parse($tambahlimamenit);

        if($data_transaksi->status == 'verified'){
            if($tanggal_hariini >= $waktu_kirim){
                $data_transaksi->status = 'delivered';
                $data_transaksi->save();

                $user = User::find($data_transaksi->user_id);
                $data = [
                    'nama'=>Auth::user()->name,
                    'massage'=>'Barang pesanan sedang dalam perjalanan',
                    'id'=>$data_transaksi->id
                ];
                
                $data_encode = json_encode($data);
        
                $user->createNotifUser($data_encode);
            }

        }

        return view('user_layouts.user_tracking', compact('data_transaksi'));
    }

    public function cancelproduct($id){
        $data_transaksi = Transactions::find($id);
        $data_transaksi->status = 'canceled';
        $data_transaksi->save();

        $user = User::find($data_transaksi->user_id);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'pembatalan transaksi anda berhasil',
            'id'=>$data_transaksi->id
        ];
        $data_encode = json_encode($data);

        $user->createNotifUser($data_encode);

        $admin = Admin::find(5);
        $data = [
            'nama'=>Auth::user()->name,
            'massage'=>'Telah membatalkan pesanan',
            'id'=>$data_transaksi->id
        ];

        $data_encode = json_encode($data);
//****************** */
        return redirect('/produk');
    }

    

}