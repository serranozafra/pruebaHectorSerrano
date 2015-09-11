@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Categor&iacute;a {{$category->name}}</div>
                    <div class="panel-body">
                        @include('categories.messages')

                        {!! Form::model($category,['route'=> ['categories.update',$category->id],'method'=>'PUT']) !!}
                        @include('categories.form')

                        <button type="submit" class="btn btn-primary">Actualizar</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection