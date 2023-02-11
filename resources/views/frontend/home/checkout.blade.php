@extends('frontend.master')


@section('content')

<div class="container">
    <div class="cart-items">
        <div class="container">
            <h2>My Shoping Bag ({{ App\Models\Cart::get()->count()}})</h2>

            <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>image</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>

                @php
                    $total = 0;
                @endphp
                @foreach ($carts as $cart)
                <tr>
                    <td>{{ $loop->index+1}}</td>
                    <td>
                        <img src="{{asset('/product/'.$cart->product->image)}}" alt="" width="70" height="70">
                    </td>
                    <td>{{$cart->product->name}}</td>
                    <td>
                        <form action="{{url('cart/product/update/'.$cart->id)}}" method="post">
                        @csrf
                        <input type="number" name="qty" value="{{$cart->qty}}">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        
                    </td>
                    <td>$ {{$cart->price}}</td>
                    <td>$ {{$cart->qty * $cart->price}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('/cart/product/delete/'.$cart->id)}}">Delete</a>
                    </td>
                </tr>

                @php
                    $total += $cart->qty * $cart->price ;
                @endphp
                @endforeach

                <tr>
                    <th colspan="4"></th>
                    <th colspan="1">Sub Total :</th>
                    <th>$ {{$total }}</th>
                    <th><a class="btn btn-success" href="#">Checkout</a></th>
                </tr>
               
            </table>
        </div>
    </div>
</div>
    
@endsection