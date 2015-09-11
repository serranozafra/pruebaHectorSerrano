@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de Colores</div>
                    <div class="panel-body">
                        @include('colors.messages')

                        <p>
                            <a href="{{ route('colors.create') }}" class="btn btn-primary">Insertar nuevo color</a>
                        </p>

                        <p>Hay {{ $colors->total() }} colores</p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Categor&iacute;a</th>
                                <th>Acciones</th>
                            </tr>

                            @foreach($colors as $color)
                            <tr id="fila{{$color->id}}">
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <a href="{{ route('colors.edit',$color->id) }}">Editar</a>
                                    <a href="{{ route('colors.translate',$color->id) }}">Traducir</a>
                                    <a href="#" onclick="eliminar_fila({{ $color->id }});">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>

                        {!! $colors->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::model($color,['route'=> ['colors.destroy',':USER-ID'],'method'=>'DELETE','id'=>'form-delete']) !!}
    {!! Form::Close() !!}
@endsection

@section('scripts')
    <script language="JavaScript">
        function eliminar_fila(id)
        {
            var form = $('#form-delete');
            var url = form.attr('action').replace(':USER-ID',id);

            var row = $('#fila'+id);



            $.post(url,form.serialize(),function(result){
                alert(result);
                row.fadeOut();
            }).fail(function(){
                alert("El color no ha sido eliminado");
            });
        }

    </script>

@endsection