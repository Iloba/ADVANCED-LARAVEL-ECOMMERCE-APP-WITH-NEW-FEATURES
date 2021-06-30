@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} | {{ __('You are logged in!') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    @include('layouts.errors')
                    <h3>Edit Product</h3>
                    <div class="product-box">
                   {{-- {{$product->name}} --}}
                        <form action="{{route('update_products', $product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <input type="text" name="product_name" class="form-control" value="{{$product->name}}" placeholder="Product Name">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="product_price" class="form-control" value="{{$product->price}}" placeholder="Product Price">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="product_category" class="form-control" value="{{$product->category}}" placeholder="Product Category">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="product_description" class="form-control" value="{{$product->description}}" placeholder="Product Description">
                            </div>
                            <div class="form-group mb-4">
                                <input type="file" name="product_image" class="form-control" placeholder="Product Image">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success">Add Product</button>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
