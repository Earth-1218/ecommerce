<table class="table table-striped ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @isset($products)
            @if(count($products) > 0)
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td><img height="20" width="20" src="{{ asset('uploads').'/'.$product->image }}"/></td>
                <td>{{ $product->price }}</td>
                <td><div style="width:80px; cursor:pointer;" onclick="showDescrition(this)" 
                    data-description="{{ $product->description }}" 
                    data-name="{{ $product->name }}" 
                    data-price="{{ $product->price }}" 
                    data-image="{{ asset('uploads').'/'.$product->image }}"><i class="fa fa-eye"></i></div>
                </td>
                <td>
                    <div class="mt-1">
                    <a class="btn btn-secondary " href="{{ route('product.show',['product'=> $product->id]) }}">View</a>
                    </div>
                    @if(auth()->user() && auth()->user()->role == 'admin')
                    <div class="mt-1">
                    <a class="btn btn-secondary " href="{{ route('product.edit',['product'=> $product->id]) }}">Edit</a>
                    </div>
                    <div class="mt-1">
                    <form method="post" id="deleteAction{{ $product->id }}" class="" action="{{ route('product.destroy',['product'=> $product->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteproduct({{ $product->id }})" class="btn btn-danger" >Delete</button>
                    </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">No Data Found</td>
            </tr>
            @endif
        @endisset
    </tbody>
</table>

<div id="description" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-name modal-header">
            </div>
            <div class="modal-desc modal-body">
            </div>
            <div class="modal-price modal-footer text-left">
            </div>
        </div>
    </div>
</div>

<script>
    function showDescrition(el){
        $('.modal-desc').html(`
            <div class="text-center">
                <img height="30%" width="70%" src="${$(el).data('image')}"/>
            </div>
            <div class="mt-2">
                ${$(el).data('description')}
            </div>
        `);
        $('.modal-name').html($(el).data('name'));
        $('.modal-price').html('Price: ₹ '+$(el).data('price'));
        $('#description').modal('show');
    }
    function deleteproduct(id){
        Swal.fire({
            title: 'Delete Product',
            text: "Are you sure you want to delete this product ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757',
            confirmButtonText: 'Delete'
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAction'+id).submit();
            }
        })
    }
</script>