@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de Productos</div>
                    <div class="panel-body">
                        @include('products.messages')

                        <p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary">Insertar nuevo producto</a>
                        </p>

                        <p>Hay {{ $products->total() }} productos</p>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Categor&iacute;a</th>
                                <th>Acciones</th>
                            </tr>

                            @foreach($products as $product)
                            <tr id="fila{{$product->id}}">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>
                                    <a href="{{ route('products.edit',$product->id) }}">Editar</a>
                                    <a href="{{ route('products.translate',$product->id) }}">Traducir</a>
                                    <a href="#" onclick="eliminar_fila({{ $product->id }});">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>

                        {!! $products->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::model($product,['route'=> ['products.destroy',':USER-ID'],'method'=>'DELETE','id'=>'form-delete']) !!}
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
                alert("El producto no ha sido eliminado");
            });
        }

    </script>

@endsection