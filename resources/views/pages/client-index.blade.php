<div class="row">
    <div class="col-md-12 isCartAvailable">
    </div>
    @isset($products)
        @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('uploads').'/'.$product->image }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <input type="hidden" class="productId" value="{{ $product->id }}"/>
                        <input type="hidden" class="productCategory" value="{{ $product->category }}"/>
                        <h5 class="card-title productName">{{ $product->name }}</h5>
                        <p class="card-text productDescription">{{ $product->description }}</p>
                        <div class="d-flex">
                        <p class="card-text ">Price: ₹ <span class="productPrice">{{ $product->price }}</span> </p>
                        &nbsp;&nbsp;
                        <p class="card-text ">Quantity: <input style="width: 60px; background:transparent; margin-left:5px; margin-top:-4px;" value="1" min="1" onchange="calculatePrice(this)" type="number" name="quantity" id="quantity" class="border-0 productQuantity"/></p>
                        </div>
                        <a href="{{ route('product.show', ['product' => $product->id]) }}" class="btn btn-secondary">View</a>
                        <button onclick="addToCart(this)" class="btn btn-secondary">Add To Cart</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col text-center">
                <p>No products found.</p>
            </div>
        @endforelse
    @endisset
</div>
<script>
    function calculatePrice(qty){
        let price = parseFloat($(qty).parent().parent().find('.productPrice').text());
        let quantity = parseInt($(qty).val());
        let total = price * quantity;
        $(qty).parent().parent().find();
        $(qty).parent().parent().find('.totalPrice').val(total);
    }

    function addToCart(element){
        let product = {
            '_token':'{{ csrf_token() }}',
            'id': $(element).parent().find('.productId').val(),
            'name': $(element).parent().find('.productName').text(),
            'category': $(element).parent().find('.productCategory').val(),
            'description': $(element).parent().find('.productDescription').text(),
            'price': parseFloat($(element).parent().find('.productPrice').text()),
            'quantity': $(element).parent().find('.productQuantity').val(),
            'total': $(element).parent().find('.productPrice').text() * $(element).parent().find('.productQuantity').val()
        }

        $.ajax({
            url: '{{ route("addToCart") }}',
            type: 'POST',
            data: product,
            success: function(response) {
                // toastr.info("Product Added To Cart");
                if($('dropdown-item').find('.cartcount'))
                {
                    $('.cartcount').html(`(${response.data.totalItems})`)
                }
                console.log(response);
                $('.isCartAvailable').html(
                    `<div  class="alert alert-info alert-dismissible fixed-bottom fade show" role="alert">
                        <div class="d-flex justify-content-between">
                            <span>Your cart has ${response.data.totalItems} item(s).</span>
                            <a href="{{ route('showCart') }}" style="cursor:pointer;">View Cart</a>
                        </div>
                    </div>`
                );
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });

    }
</script>
