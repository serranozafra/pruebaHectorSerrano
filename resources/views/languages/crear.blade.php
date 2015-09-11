@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A&ntilde;adir Idioma</div>
                    <div class="panel-body">
                        @include('languages.messages')

                        {!! Form::Open(['route'=>'languages.store','method'=>'POST']) !!}
                            @include('languages.form')

                            <button type="submit" class="btn btn-primary">A&ntilde;adir</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection