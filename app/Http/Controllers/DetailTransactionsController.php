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
use App\Models\Transaction_detail;
use Illuminate\Support\Facades\Storage;

class DetailTransactionsController extends Controller
{
	
	function index(){

    	//syntax get data dari database
		// $data['products'] = Product::join('product_category_details', 'products.id', 'product_category_details.product_id')->leftJoin('product_images', 'products.id', 'product_images.product_id')->select('products.*', 'product_category_details.category_id', 'image_name')->get();
		// $data['transactions'] = Transaction::all();
		// dd($data);
		// $data_transaksi = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
    $data['id'] = Transaction::findOrFail($_GET['id'])->id;
		// return view('admin.listtransaksi', $data);
		$data['category'] = Product_categorie::all();

		// $data['transactionsdtl'] = Transaction_detail::where('transaction_id', $data['id'])->orderBy('created_at', 'desc')->get();
		$data['transactionsdtl'] = Transaction_detail::where('transaction_id', $data['id'])->get();
		// $data['transactionsdtl'] = Transaction_detail::all();
		return view('admin.listtransaksidtl', $data);
	}
}