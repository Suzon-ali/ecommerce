<?php

namespace App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Catergory;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $addToCart = new Cart();
        $addToCart->ip_address = $request->ip();
        $addToCart->product_id = $request->product_id;
        $addToCart->price      = $request->product_price;
        $addToCart->qty = 1;
        $addToCart->total_price = 1*$request->product_price;
        $addToCart->save();
        return redirect()->back()->with(session()->flash('success', 'Product has been added to cart'));

    }

    public function checkOut()
    {
        $categories = Catergory::orderby('id', 'asc')->where('status',1)->get();
        $carts = Cart::with('product')->where('ip_address', request()->ip())->get();
        return view('frontend.home.checkout', compact('categories', 'carts'));
    }

    public function cartDelete($id)
    {
        $carts = Cart::find($id);
        $carts->delete();
        return redirect()->back()->with(session()->flash('warning', 'Product has been Deleted'));

    }

    public function updateQTY( Request $request, $id)
    {
        $cartQtyUpdate = Cart::find($id);
        $cartQtyUpdate->qty = $request->qty;
        $cartQtyUpdate->save();
        return redirect()->back()->with(session()->flash('success', 'Product Quantity has been updated'));
    }
}
