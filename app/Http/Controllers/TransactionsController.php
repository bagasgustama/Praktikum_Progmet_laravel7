<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Product_categorie;
use App\Models\Product_category_detail;
use App\Models\Product_image;
use App\Models\Product_review;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

class TransactionsController extends Controller
{
	
	function index(){

    	//syntax get data dari database
		// $data['products'] = Product::join('product_category_details', 'products.id', 'product_category_details.product_id')->leftJoin('product_images', 'products.id', 'product_images.product_id')->select('products.*', 'product_category_details.category_id', 'image_name')->get();
		// $data['transactions'] = Transaction::all();
		// dd($data);
		// $data_transaksi = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();

		// return view('admin.listtransaksi', $data);
		$data['category'] = Product_categorie::all();

		$data['transactions'] = Transaction::orderBy('created_at', 'desc')->get();
		return view('admin.listtransaksi', $data);
	}
	

	function ubahtransactionpage(){
		//syntax cek produk dengan id
		
		// Product::findOrFail($_GET['id']);
		$data['category'] = Product_categorie::all();
		
		//get data produk berdasarkan id
		$data['id'] =Transaction::findOrFail($_GET['id'])->id;
		$data['transactions'] = Transaction::all();
		// dd(Transaction::all());

		return view('admin.ubahtransaction', $data);
		}

		function ubahstatus(Request $req){    

			//validasi inputan	
			// $req->validate([
			// 	'status' => 'required',
			// 	'product_name' => 'required',
			// 	'harga' => 'required',
			// 	'deskripsi' => 'required',
			// 	// 'rating' => 'required',
			// 	'stok' => 'required',
			// 	'berat' => 'required'
			// ],[
			// 	'kategori.required' => "Pilih kategori produk terlebih dahulu",
			// 	'product_name.required' => "Nama produk harus diisi",
			// 	'harga.required' => "Harga produk harus diisi",
			// 	'deskripsi.required' => "Deskripsi produk harus diisi",
			// 	// 'rating.required' => "Rating produk harus diisi",
			// 	'stok.required' => "Stok produk harus diisi",
			// 	'berat.required' => "Berat produk harus diisi",
			// ]);
			//cek ada tidaknya produk dengan id sekian
			$data =Transaction::findOrFail($_GET['id'])->id;
			// dd($data);
			// Transaction::findOrFail($req->id);
		
			try {
				Transaction::where('id', $data)->update([
					'status' => $req->status
					// 'price' => $req->harga,
					// 'description' => $req->deskripsi,
					// 'product_rate' => $req->rating,
					// 'stock' => $req->stok,
					// 'weight' => $req->berat
					
					]);
					// dd($req->status);
		
				// Product_category_detail::where('product_id', $data)->update([
				// 	'status' => $req->status
				// ]);
		
				return redirect('/list/transaction')->with('sukses', 'Data produk berhasil diubah');
			} catch (Exception $e) {
				return redirect('/list/transaction')->with('gagal', 'Data produk gagal diubah');
			}
		}
}