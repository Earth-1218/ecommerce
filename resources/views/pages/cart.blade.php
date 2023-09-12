@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Shopping Cart</h5>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Continue Shopping</a>
                </div>
                <div class="card-body">
                <form action="{{ route('checkout') }}" method="post">                    
                @csrf    
                @if(Session::has('cart'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $products = Session::get('cart') @endphp
                            @if(count($products) > 0)
                            @foreach ($products as $key => $product)
                            <tr>
                                <td id="id{{$key}}" class="id">{{ $product['id'] }} <input type="hidden" name="products[{{ $key }}][id]" value="{{ $product['id'] }}"></td>
                                <td id="name{{$key}}" class="name">{{ $product['name'] }} <input type="hidden" name="products[{{ $key }}][name]" value="{{ $product['name'] }}"></td>
                                <td>₹ <span id="price{{$key}}" class="price">{{ $product['price'] }}</span> <input type="hidden" name="products[{{ $key }}][price]" value="{{ $product['price'] }}"></td>
                                <td><input id="quantity{{$key}}" class="quantity" onchange="total(this)" min="1" style="width:50px;" type="number" name="products[{{ $key }}][quantity]" value="{{ $product['quantity'] }}"></td>
                                <td>₹ <span id="total{{$key}}" class="total">{{ $product['price'] * $product['quantity'] }}</span><input type="hidden" name="products[{{$key}}][total]" value="{{ $product['price'] * $product['quantity'] }}"></td>
                                <td><a href="javascript:void(0)" data-id="{{ $product['id'] }}" onclick="removeFromCart(this)" class="btn btn-danger btn-sm">Remove</a></td>
                            </tr>
                            @endforeach                            
                            @else
                            <tr>
                                <td colspan="6" class="text-center">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td>₹ <span id="grandTotal"></span></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        @if(count($products) > 0)
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">Add more products</a>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-secondary">Checkout</button>&nbsp;&nbsp;
                        <a href="{{ route('cancelCart') }}" class="btn btn-danger">Make cart Empty</a> 
                        @endif
                    </div>
                @endif
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function removeFromCart(el) {
    let productId = $(el).data('id');
    $.ajax({
        url: `{{ asset('') }}removeFromCart/${productId}`,
        type: 'get',
        success: function(response) {
            // toastr.warning('Product Removed from cart');
            if (response.data.totalItems > 0) {
                $('.cartcount').html(`(${response.data.totalItems})`);
                $(el).parent().parent().remove();
                grandTotal();
            } else {
                window.location.href = `{{ url('/') }}`;
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

grandTotal();

function total(el) {
    let row = $(el).closest('tr');
    let price = parseFloat(row.find('.price').text());
    let quantity = parseFloat(row.find('.quantity').val());
    let total = price * quantity;
    row.find('.total').html(`${total}`);
    grandTotal();
}

function calculateGrandTotal() {
    let total = parseFloat(0);
    $('.total').each(function() {
        let totalValue = $(this).text();
        total += parseFloat(totalValue);
    });
    return total;

}

function grandTotal() {
    let total = calculateGrandTotal();
    $('#grandTotal').text(`${total.toFixed(2)}`);
}

</script>
@endsection
