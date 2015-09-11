@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A&ntilde;adir Categor&iacute;a</div>
                    <div class="panel-body">
                        @include('categories.messages')

                        {!! Form::Open(['route'=>'categories.store','method'=>'POST']) !!}
                            @include('categories.form')

                            <button type="submit" class="btn btn-primary">A&ntilde;adir</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection