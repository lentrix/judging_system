@if($message = Session::get('Error') )

    <div class="alert alert-danger">
        {{$message}}
    </div>

@endif

@if($message = Session::get('Info') )

    <div class="alert alert-info">
        {{$message}}
    </div>

@endif

@if(count($errors)>0)

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $err)

            <li>{{$err}}</li>

            @endforeach
        </ul>
    </div>

@endif
