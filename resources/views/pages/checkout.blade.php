@extends('layouts.app')

@section('content')
@if(!Session::has('cart'))
   @php
       header("Location:".route('order.index'));
 exit;
   @endphp
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Order Details</h5>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="card-body">
                @if(Session::has('cart'))
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('order.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $orderId }}"/>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
                                <input type="hidden" name="total" class="grandTotal" value=""/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h4>Customer Information</h4>
                                        </div>
                                        <div class="card-body">
                                        <div class="form-group">
                                            <label for="name mt-2">Name</label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" id="name" name="name" required>
                                        </div> 
                                        <div class="form-group mt-2">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" id="email" name="email" required>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="address">Address</label>
                                            <textarea cols="3" class="form-control" id="address" name="address" required></textarea>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                        <h4>Order Summary</h4>
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
                                                @php $products = Session::get('cart') @endphp
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product['name'] }}</td>
                                                    <td>{{ $product['quantity'] }}</td>
                                                    <td>₹ {{ $product['price'] }}</td>
                                                    <td class="total">₹ {{ $product['price'] * $product['quantity'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                   <td colspan="3"> Total</td>
                                                   <td> ₹ <input style="width: 100px; background:transparent; border:none;" type="text" readonly  id="grandTotal" class="grandTotal" /></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        </div>
                                        <div class="m-3">
                                            <label for="payment_mode">Payment Mode</label>
                                            <select class="form-control mt-1" name="payment_mode">
                                                <option value="cash">Cash on delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                        <input type="hidden" name="details" value="#"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('product.index') }}" class="btn btn-secondary ">Add more products</a>&nbsp;&nbsp;
                                <button type="submit" class="btn btn-secondary">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let grandTotal = 0.00;
        $('.total').each(function() {
                let total = $(this).text().replace('₹','');
                grandTotal += parseFloat(total)
        });
        $('.grandTotal').val(grandTotal.toFixed(2));
    }); 
</script>
@endsection