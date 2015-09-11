<div class="form-group">
    {!!  Form::label('name','Nombre') !!}
    {!!  Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Introduzca nombre del producto']) !!}
</div>

<div class="form-group">
    {!! Form::label('price','Precio') !!}
    {!! Form::number('price',null,['class' => 'form-control', 'placeholder' => 'Introduzca el precio del producto'])  !!}
</div>

<div class="form-group">
    {!! Form::label('id_category','Categor&iacute;a') !!}
    {!! Form::select('id_category',$arrayCat,null,['class' => 'form-control', 'placeholder' => 'Introduzca categor&iacute;a del producto'])  !!}
</div>

<div class="form-group">
    {!! Form::label('colors','Colores') !!}
    <div>
        @foreach($colors as $idCol => $col)
            <label class="checkbox-inline">
                <input type="checkbox" id="color{{$idCol}}" name="color{{$idCol}}" value="{{ $idCol }}"  {{ $col["checked"] }}>{{ $col["name"] }}
            </label>
        @endforeach
    </div>
</div>



<div class="form-group">
    {!! Form::label('description','Descripci&oacute;n') !!}
    {!! Form::textarea('description',null,['class' => 'form-control', 'rows'=>3, 'placeholder' => 'Introduzca descripci&oacute;n del producto'])  !!}
</div>