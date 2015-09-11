@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de Categor&iacute;as</div>
                    <div class="panel-body">
                        @include('categories.messages')

                        <p>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">Insertar nueva categor&iacute;a</a>
                        </p>

                        <p>Hay {{ $categories->total() }} categor&iacute;as</p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Categor&iacute;a</th>
                                <th>Acciones</th>
                            </tr>

                            @foreach($categories as $category)
                            <tr id="fila{{$category->id}}">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit',$category->id) }}">Editar</a>
                                    <a href="{{ route('categories.translate',$category->id) }}">Traducir</a>
                                    <a href="#" onclick="eliminar_fila({{ $category->id }});">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>

                        {!! $categories->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::model($category,['route'=> ['categories.destroy',':USER-ID'],'method'=>'DELETE','id'=>'form-delete']) !!}
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
                alert("La categoria no ha sido eliminada");
            });
        }

    </script>

@endsection