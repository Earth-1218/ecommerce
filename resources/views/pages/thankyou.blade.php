@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Thank You for Your Order!</h1>
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Order Details</h2>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Order ID: {{ $orderDetails['id'] }}</li>
                        <li>Invoice ID: {{ $orderDetails['order_id'] }}</li>
                        <li>Total Amount: {{ $orderDetails['total'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>User Details</h2>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Name: {{ $userDetails['name'] }}</li>
                        <li>Email: {{ $userDetails['email'] }}</li>
                        <li>Address: {{ $orderDetails['address'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Order Tracking</h2>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Invoice ID: {{ $orderDetails['order_id'] }} </li>
                        @if($orderDetails['shipping_id'])
                        <li>Shipping ID: </li>
                        @else
                        <li>Order not Shipped</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>        
    </div>
    <div class="text-center mt-4">
        <a class="btn btn-secondary" href="{{ route('order.index') }}">View orders</a>
    </div>
</div>
@endsection
