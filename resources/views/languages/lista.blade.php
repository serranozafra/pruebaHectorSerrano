@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de Idiomas</div>
                    <div class="panel-body">
                        @include('languages.messages')

                        <p>
                            <a href="{{ route('languages.create') }}" class="btn btn-primary">Insertar nuevo idioma</a>
                        </p>

                        <p>Hay {{ $languages->total() }} idiomas</p>

                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Categor&iacute;a</th>
                                <th>Acciones</th>
                            </tr>

                            @foreach($languages as $language)
                            <tr id="fila{{$language->id}}">
                                <td>{{ $language->id }}</td>
                                <td>{{ $language->name }}</td>
                                <td>
                                    <a href="{{ route('languages.edit',$language->id) }}">Editar</a>
                                    <a href="#" onclick="eliminar_fila({{ $language->id }});">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>

                            {!! $languages->render() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::model($languages,['route'=> ['languages.destroy',':USER-ID'],'method'=>'DELETE','id'=>'form-delete']) !!}
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
                alert("El idioma no ha sido eliminado");
            });
        }

    </script>

@endsection