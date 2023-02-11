<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Catergory::orderby('id', 'asc')->where('status',1)->get();
        $products = Product::orderby('id', 'desc')->where('status',1)->get();
        return view('frontend.home.index', compact('categories', 'products'));
    }


  



}
