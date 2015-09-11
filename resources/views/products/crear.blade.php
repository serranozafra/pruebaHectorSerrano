@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A&ntilde;adir Producto</div>
                    <div class="panel-body">
                        @include('products.messages')

                        {!! Form::Open(['route'=>'products.store','method'=>'POST']) !!}
                            @include('products.form')

                            <button type="submit" class="btn btn-primary">A&ntilde;adir</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection