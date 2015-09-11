@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Traducir Producto {{$product->name}}</div>
                    <div class="panel-body">
                        @include('products.messages')

                        {!! Form::model($product,['route'=> ['products.translate.update',$product->id],'method'=>'PUSH']) !!}

                        <div>
                            <h1>Idioma Original</h1>

                            <div class="form-group">
                                {!!  Form::label('name','Nombre') !!}
                                {!!  Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Introduzca nombre del producto']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description','Descripci&oacute;n') !!}
                                {!! Form::textarea('description',null,['class' => 'form-control', 'rows'=>3, 'placeholder' => 'Introduzca descripci&oacute;n del producto'])  !!}
                            </div>
                         </div>

                        @foreach($languages as $language)
                            <div>
                                <h1>{{ $language->name }}</h1>

                                <div class="form-group">
                                    {!!  Form::label('name'.$language->id,'Nombre') !!}
                                    {!!  Form::text('name'.$language->id,$arrayLan[$language->id]["name"],['class' => 'form-control', 'placeholder' => 'Introduzca la traducci&oacute;n del nombre al '.$language->name]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description'.$language->id,'Descripci&oacute;n') !!}
                                    {!! Form::textarea('description'.$language->id,$arrayLan[$language->id]["description"],['class' => 'form-control', 'rows'=>3, 'placeholder' => 'Introduzca la traducci&oacute;n de la descripci&oacute;n al '.$language->name])  !!}
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