@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header d-flex justify-content-sm-between">
                    <h5>Categories </h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li><a class="text-muted text-decoration-none" href="{{ env('APP_URL') }}">All</a></li>
                        @foreach (Session::get('categories') as $key => $category)
                        <li><a class=" @if(isset($_REQUEST['category']) && $_REQUEST['category'] == $key) text-red @else text-muted @endif text-decoration-none" href="{{ env('APP_URL') }}/product?category={{ $key }}">{{ $category }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-sm-between">
                    <h5>Products List  &nbsp; <small>@if(isset($_REQUEST['category'])) #  {{ Session::get('categories')[$_REQUEST['category']] }}  @endif</small> </h5>
                    @if(auth()->user() && auth()->user()->role == 'admin' )
                    <span>
                        <a href="{{ route('product.create') }}" class="btn btn-secondary">Create product</a>
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    @if(auth()->user() !== null && auth()->user()->role =='admin')
                        @include('pages.index')
                    @else
                        @include('pages.client-index')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
