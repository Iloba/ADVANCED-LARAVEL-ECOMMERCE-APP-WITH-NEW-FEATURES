@include('layouts.header')
<section class="main-section p-5">
   <div class="container">
        <div class="row">
            <div class="col-md-5 mt-5 mx-auto">
                <div class="card p-5 shadow">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Welcome, Please Login Below</h2>
                        <form action="{{route('signin_customer')}}" method="POST">
                            @csrf
                            
                            <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" >
                            <input type="password" name="password"  class="form-control mb-3" placeholder="Password" >
                            <button type="submit" class="btn btn-success">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
@include('layouts.footer')