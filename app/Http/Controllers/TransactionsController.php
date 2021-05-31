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
		$data['transactions'] = Transaction::all();
		// dd($data);

		return view('admin.listtransaksi', $data);
  }
}