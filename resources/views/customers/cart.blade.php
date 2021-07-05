@include('layouts.header')
<div class="main-section">
    <div class="container p-3 mt-5">
        <a href="{{route('order')}}" class="btn btn-success mb-3">Order Now</a>
        @include('layouts.errors')
        <div class="row">
           
            @foreach ($products as $items)
                <div class="col-md-12">
                   
                    <div class="card shadow p-3 mb-4">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <img class="img-fluid" style="max-width: 200px;" src="{{asset('/storage/products/'.$items->image)}}" alt="">
                            </div>
                            <div class="col-md-4">
                               <h5>Product Name:  {{$items->name}}</h5>
                               <h5>Product Category: {{$items->category}}</h5>
                               <h5>Product Category: {{$items->description}}</h5>
                               <h5 class="text-success">Price: N {{$items->price}}</h5>
                            </div>
                            <div class="col-md-4">
                                <form action="{{route('remove_from_cart', $items->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Remove from Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
          
        </div>
    </div>
</div>
@include('layouts.footer')




