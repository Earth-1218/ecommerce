@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-sm-between">
                    <span>Product Form</span>
                    <span>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                    </span>
                </div>
                <div class="card-body">
                    <form method="post" action="@if(isset($product)) {{ route('product.update', ['product' => $product->id]) }} @else {{ route('product.store') }} @endif" enctype="multipart/form-data">  
                        @csrf
                        @if(isset($product))
                            @method('PATCH')
                        @endif
                        <div class="form-group">
                            <label for="name required">Name</label>
                            <input class="form-control" type="text" placeholder="product name" name="name" id="name" value="@isset($product) {{ $product->name }} @endisset" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label for="category required">Categories</label>
                            <select class="form-control " name="category" id="category" required>
                                <option>Please select</option>
                                @foreach (Session::get('categories') as $key => $category)
                                <option value="{{ $key }}" @if(isset($product) && $key == $product->category) selected  @endif>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image required">Image</label>
                            <input class="form-control @if(isset($product) && $product->image) d-none @endif" type="file" name="image" id="image" accept="image/png, image/jpeg" required/>
                            @isset($product)
                                @if($product->image)
                                <div class="text-left p-3">
                                    <img id="productImage" onclick="this.addEventListener('click', function() { document.getElementById('image').click(); this.name   })" height="100" width="100" src="{{ asset('uploads').'/'.$product->image }}" />
                                </div>
                                <input type="hidden" name="current_image" value="{{ $product->image }}">
                                @endif
                            @endisset
                        </div>
                        <div class="form-group mt-2">
                            <label for="price required">Price</label>
                            <input class="form-control" type="text" pattern="\d*\.?\d*" title="Only decimal values allowed."  placeholder="product price" name="price" id="price" value="@isset($product){{ $product->price }}@endisset" pattern="\d*\.?\d*" title="Only decimal values allowed." required/>
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" cols="3" name="description" placeholder="Product Description" id="description">@isset($product) {{ $product->description }} @endisset</textarea>
                        </div>
                        <div class="form-group mt-3 ">
                            <button type="submit" class="btn btn-secondary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     document.getElementById('image').addEventListener('change', function(event) {
      const selectedFile = event.target.files[0];
      if (selectedFile) {
        document.getElementById('productImage').src = `{{ asset('uploads') }}/${selectedFile.name}`;
      }
    });
</script>
@endsection
