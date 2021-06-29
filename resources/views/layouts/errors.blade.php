@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>

@elseif(session('error'))

    <div class="alert alert-dager">
        {{session('danger')}}
    </div>
    
@endif

@if ($errors->all())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
   
@endif