@include('layouts.header')
<div class="container">
    @include('layouts.errors')
    <div class="col-md-12 mb-2">
        <h4 class="mb-4 mt-4">My Orders</h4>
        @foreach ($products as $orderedItem)
            <div class="card shadow mb-3 p-2">
                <div class="row p-3">
                    <div class="col-md-7 ">
                        <img class="img-fluid " style="width: 200px;" src="{{asset('/uploads/products/'.$orderedItem->image)}}" alt="dd">
                    </div>
                    <div class="col-md-5">
                        <h2>{{$orderedItem->name}}</h2>
                        <p>{{$orderedItem->description}}</p>
                        <h5>N{{$orderedItem->price}}</h5>
                        <h5>Status: {{$orderedItem->status}}</h5>
                        <h5>Payment Method: {{$orderedItem->payment_method}}</h5>
                        <h5>Payment Status: {{$orderedItem->payment_status}}</h5>
                        <h5>Delivery Address: {{$orderedItem->address}}</h5>
                        <h5>Order Date: {{\Carbon\Carbon::parse($orderedItem->created_at)->diffForHumans() }}</h5>
                       
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')