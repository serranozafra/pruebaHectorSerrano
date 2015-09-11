@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualizar Idioma {{$language->name}}</div>
                    <div class="panel-body">
                        @include('languages.messages')

                        {!! Form::model($language,['route'=> ['languages.update',$language->id],'method'=>'PUT']) !!}
                        @include('languages.form')

                        <button type="submit" class="btn btn-primary">Actualizar</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection