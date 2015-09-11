@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Producto {{$product->name}}</div>
                    <div class="panel-body">
                        @include('products.messages')

                        {!! Form::model($product,['route'=> ['products.update',$product->id],'method'=>'PUT']) !!}
                        @include('products.form')

                        <button type="submit" class="btn btn-primary">Actualizar</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection