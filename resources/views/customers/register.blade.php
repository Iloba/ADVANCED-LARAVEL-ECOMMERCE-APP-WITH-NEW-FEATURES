@include('layouts.header')
<section class="main-section p-5">
   <div class="container">
        <div class="row">
           
            <div class="col-md-10 mx-auto">
                <div class="card p-3 shadow">
                    <div class="card-body">
                        @include('layouts.errors')
                        <h2 class="mb-4 text-center">Welcome, Please Register Below</h2>
                        <form action="{{route('create_customer')}}" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control mb-3" placeholder="Name" >
                            <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" >
                            <input type="password" name="password"  class="form-control mb-3" placeholder="Password" >
                            <input type="password" name="password_confirmation"  class="form-control mb-4" placeholder="Confirm Password" >
                            <button type="submit" class="btn btn-success mb-3">Register</button> <br>
                            <a href="{{route('login_customers')}}">Already Have an Account?? Login Here</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</section>
@include('layouts.footer')