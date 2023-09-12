@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Orders List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Shipping ID</th>
                            <th>Order Status</th>
                            <th>Payment Mode</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        @if(count($orders) > 0)
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ ($order->shipping_id) ? $order->shipping_id : 'Not Shipped' }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ ucfirst($order->payment_mode) }}</td>
                            <td>{{ ($order->payment_status) ? 'Paid' : 'Pending' }}</td>
                            <td><a href="{{ route('order.show',['order'=>$order->id]) }}">View</a></td>
                        </tr> 
                        @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="6">No Data Found</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


