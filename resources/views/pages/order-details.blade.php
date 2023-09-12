@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        #{{ $order->order_id }}
                    </div>
                    <a class="btn btn-secondary" href="{{ route('order.index') }}">Back</a>
                </div>      
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($order->details)}} --}}
                            @foreach($order->details as $detail)
                            <tr>
                                
                                
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->product->price,2) }} ₹</td>
                                <td>{{ number_format($detail->product->price * $detail->quantity,2) }} ₹ </td>
                            </tr>
                            @endforeach
                            <tr >
                                <td class=" bg-secondary text-white" colspan="3">Total</td>  
                                <td class=" bg-secondary text-white">{{ number_format($order->total,2) }} ₹ </td>   
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <strong>Address Details </strong>                        
                    </div>
                </div>      
                <div class="card-body">
                    <ul>
                        <li>{{ $order->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <strong>Order Details </strong>                        
                    </div>
                </div>      
                <div class="card-body">
                   <ul>
                        <li>Name : {{ $order->name }}</li>
                        <li>Email : {{ $order->email }}</li>
                        <li>Order Id : {{ $order->order_id }}</li>
                        <li>Order Status : {{ $order->status }}</li>
                   </ul>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
