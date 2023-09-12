<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function createCart(Request $request){
        $cartItem = $request->except('_token');
        if(Session::has('cart')) {
            Session::push('cart', $cartItem);
        } else {
            Session::put('cart', [$cartItem]);
        }
        return view('pages.cart');
    }

    public function showCart(){
        return view('pages.cart');
    }

    public function cancelCart(){
        Session::forget('cart');
        return redirect('home');
    }  

    //for api
    public function addToCart(Request $request){
        $cartItem = $request->except('_token');
        if(Session::has('cart')) {
            Session::push('cart', $cartItem);
        } else {
            Session::put('cart', [$cartItem]);
        }
        return response()->json(['status'=>true,'data'=>['totalItems'=>count(Session::get('cart'))], 'message'=>'Product added to cart!'],200);    
    }

    //for api
    public function removeFromCart($productId){
        $cart = Session::get('cart');
        foreach ($cart as $key => $product) {
            if ($product['id'] == $productId) {
                unset($cart[$key]); 
                break; 
            }
        }
        $cart = array_values($cart);
        Session::put('cart', $cart); 
        return response()->json(['status'=>true,'data'=>['totalItems'=>count(Session::get('cart'))], 'message'=>'Product removed from cart!'],200);
    }

    public function checkout(Request $request){
        $cart = $request->except('_token');
        $cart_old = Session::get('cart');
        Session::put('cart', $cart['products']);
        $cart_new = Session::get('cart');
        // dd(['old' => $cart_old,'new' => $cart_new]);
        $orderId = 'INV'.rand(11111,99999);
        return view('pages.checkout')->with('orderId',$orderId);
    }

    // public function checkout(){
    //     $orderId = 'INV'.rand(11111,99999);
    //     return view('pages.checkout')->with('orderId',$orderId);
    // }
}
