@include('layouts.header')
<div class="main-section ">
  @include('layouts.errors')
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100"  src="{{asset('storage/products/yakata.png')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('storage/products/yakata2.png')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('storage/products/yakata3.png')}}" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('storage/products/yakata3.png')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
    
    <h2 class="text-center mb-5 mt-5">Our Products</h2>
    <div class="container mt-3 mb-3">
            <div class="row">
                @foreach ($products as $item)
                <div class="col-md-3 mb-3">
                   
                    <div class="card shadow">
                        <div class="card card-body">
                            <img class="d-block img-fluid w-100" src="{{asset('uploads/products/'.$item->image)}}" alt="First slide">
                        </div>
                        <div class="p-3">
                            <h5>{{$item->name}}</h5>
                            <h5 class="text-success">N{{$item->price}}</h5>
                            <small>Product by: {{$item->user->name}}</small>
                            <div class="d-flex">
                               <form action="{{route('add_to_cart')}}" class="m-1" method="POST">
                                 @csrf
                                 <input type="text" name="product_id" class="d-none" value="{{$item->id}}">
                                 <button type="submit" class="btn btn-success">Add to Cart</button>
                               </form>
                                <button class="m-1 btn btn-warning" data-toggle="modal" data-target="#productModal-{{$item->id}}" ><i class="icofont icofont-eye"></i></button>
                            </div>
                        </div>
                        <div class="modal fade" id="productModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{$item->name}}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-7">
                                      <img class="d-block img-fluid w-100" src="{{asset('storage/products/'.$item->image)}}" alt="First slide">
                                    </div>
                                    <div class="col-md-5 mt-3">
                                      <h5 class="fw-bold"> <b></b>{{$item->description}}</h5>
                                      <h5> <b>Price: </b>N{{$item->price}}</h5>
                                      <p><i>Shipping fee inclusive</i></p>
                                      <div class="mt-2">
                                        <form action="{{route('add_to_cart')}}" method="POST">
                                            @csrf
                                            <input type="text" name="product_id" class="d-none" value="{{$item->id}}">
                                         <button type="submit" class="btn btn-success btn-block " href="">Add to Cart <i class="icofont-cart-alt"></i></button>
                                        </form>
                                     </div>
                                    </div>
                                 </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
              {{$products->links()}}
            </div>
    </div>

    {{-- {{$latestProducts}} --}}
</div>
@include('layouts.footer')