@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Color {{$color->name}}</div>
                    <div class="panel-body">
                        @include('colors.messages')

                        {!! Form::model($color,['route'=> ['colors.update',$color->id],'method'=>'PUT']) !!}
                        @include('colors.form')

                        <button type="submit" class="btn btn-primary">Actualizar</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection