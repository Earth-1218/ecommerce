@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Product Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img height="200" width="200" src="{{ asset('uploads/'.$product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{ route('createCart') }}">
                                @csrf
                                <h2>{{ $product->name }}</h2>
                                <p>{{ $product->description }}</p>
                                <div class="d-flex">
                                <p><span>Price: ₹ {{ $product->price }}</span> &nbsp;x &nbsp;<input class="border-0" style="width:60px; background:transparent;" type="number" min="1" name="quantity" id="quantity" value="1" /></p>
                                </div>
                                {{-- {!! json_encode(Session::get('cart')) !!} --}}
                                <input type="hidden" name="id" id="id" value="{{ $product->id }}" />
                                <input type="hidden" name="name" id="name" value="{{ $product->name }}" />
                                <input type="hidden" name="category" id="category" value="{{ $product->category }}" />
                                <input type="hidden" name="price" id="price" value="{{ $product->price }}" />
                                <input type="hidden" name="description" id="description" value="{{ $product->description }}" />
                                <p>Total: ₹ <input type="text" name="total" class="border-0" style="background:transparent;" value="40.00" id="totalPrice" readonly/></p>
                                <button class="btn btn-secondary add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     const addToCartButtons = document.querySelectorAll('.add-to-cart');
    //     addToCartButtons.forEach(button => {
    //         button.addEventListener('click', () => {
    //             const productId = button.getAttribute('data-product-id');    
    //             alert('Product added to cart!');
    //         });
    //     });
    // });
    $('#quantity').on('change',function(){
        var total = $('#price').val() *  $(this).val();
        $('#totalPrice').val(total.toFixed(2));
    });
</script>
@endsection


