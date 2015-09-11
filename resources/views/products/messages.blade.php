@if(Session::has('message'))
    <p class="alert alert-success">{{ Session::get('message') }}</p>
@endif


@if($errors->any())
    <div class="alert alert-danger">
        <p> Se han producido los siguientes errores:</p>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif