<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role == 'client'){
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        }else{
        $orders = Order::orderBy('id','desc')->get();
        }
        return view('pages.orders')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = $request->except('_token');
        $orderDetails = Order::create($order);
        $userDetails = auth()->user();
        $productDetails = session()->get('cart');
        foreach($productDetails as $product){
            $orderedProduct = new OrderedProduct;
            $orderedProduct->order_id = $orderDetails['id'];
            $orderedProduct->product_id = $product['id'];
            $orderedProduct->quantity = $product['quantity'];
            $orderedProduct->save();
        }
        // Session::put($orderDetails['order_id'],session()->get('cart'));
        session()->forget('cart');
        return view('pages.thankyou', compact('orderDetails', 'userDetails'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        $details = $order->orderedProducts;
        $order['details'] = $details;
        return view('pages.order-details',['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
