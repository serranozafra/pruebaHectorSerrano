@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Traducir Color {{$color->name}}</div>
                    <div class="panel-body">
                        @include('colors.messages')

                        {!! Form::model($color,['route'=> ['colors.translate.update',$color->id],'method'=>'PUSH']) !!}

                        <div>
                            <h1>Idioma Original</h1>

                            <div class="form-group">
                                {!!  Form::label('name','Nombre') !!}
                                {!!  Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Introduzca nombre del color']) !!}
                            </div>
                         </div>

                        @foreach($languages as $language)
                            <div>
                                <h1>{{ $language->name }}</h1>

                                <div class="form-group">
                                    {!!  Form::label('name'.$language->id,'Nombre') !!}
                                    {!!  Form::text('name'.$language->id,$arrayLan[$language->id]["name"],['class' => 'form-control', 'placeholder' => 'Introduzca la traducci&oacute;n del color al '.$language->name]) !!}
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Traducir</button>

                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection