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
                    <h3>Myproducts</h3>
                    <div class="product-box">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/NO</th>    
                                        <th>Name</th>    
                                        <th>Price</th>    
                                        <th>Category</th>    
                                        <th>Description</th>    
                                        <th>Image</th>    
                                        <th>Operations</th>    
                                    </tr>    
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                {{$product->id}}
                                            </td>
                                            <td>
                                                {{$product->name}}
                                            </td>
                                            <td>
                                                {{$product->price}}
                                            </td>
                                            <td>
                                                {{$product->category}}
                                            </td>
                                            <td>
                                                {{$product->description}}
                                            </td>
                                            <td>
                                                {{$product->image}}
                                            </td>
                                            <td>
                                               <a class="btn btn-warning" href="{{route('edit_product', $product)}}"><i class="icofont icofont-edit"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="{{route('delete_product', $product->id)}}"
                                                    
                                                    onclick="event.preventDefault();
                                                    if(confirm('Do you really want to Delete this Todo?')){
                                                        document.getElementById('form-delete-{{$product->id}}').submit();
                                                    }">
                                                    
                                                    <i class="icofont icofont-trash"></i></a>

                                                <form action="{{route('delete_product', $product->id)}}" id="form-delete-{{$product->id}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                               </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
