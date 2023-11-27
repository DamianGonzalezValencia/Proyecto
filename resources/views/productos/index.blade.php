@extends('layouts.app')
<title>Productos</title>
@section('template_title')
    Productos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('LISTADO DE PRODUCTOS') }}
                            </span>

                            <form action="{{route('productos.index')}}" method="GET" class="col-5" style="margin-top:1%">
                                <div class="input-group">
                                    <input type='text' class="form-control" name="busqueda">
                                    <div class="input-group-append" style="margin-left:1%">
                                        <input type='submit' class="btn btn-primary" value="Buscar">
                                    </div>
                                </div>
                            </form>
                        
                                    
                            <div class="float-right" style="padding-right:5%">
                                <a href="{{ route('productos.create') }}" style="font-size:110%" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('INGRESAR PRODUTO NUEVO') }}
                                </a>
                            </div>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                            
                                <thead class="thead">
                                    <tr>
                                        <th style="width:3%;">N°</th>
                                        
										<th>Id</th>
										<th>Nombre de Producto</th>
                                        <th>Stock</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $paginacion)
                                        <tr>
                                            
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align:center">{{ $paginacion->id_pro }}</td>
											<td>{{ $paginacion->nombre_pro }}</td>
                                            <td style="text-align:center">{{ $paginacion->cantidad_pro }}</td>
                                            <td>{{ $paginacion->categoria->nombre_cat }}</td><!-- PUEDE QUE HAYA QUE SOLO QUITAR LA LETRA "S" -->
                                            <td>{{ $paginacion->marca->nombre_mar }}</td>
                                            

                                            <td>
                                                <form action="{{ route('productos.destroy',$paginacion->id_pro) }}" class="formulario-de-confirmacion" method="POST">
                                                <a class="btn btn-sm btn-primary" href="{{route('productos.show',$paginacion->id_pro) }}"><i class="fa fa-fw fa-eye"></i> {{ __('DETALLES') }}</a>    
                                                <a href="{{ route('productos.aumentarStock', ['id_pro' => $paginacion->id_pro]) }}" class="btn btn-sm btn-success">
                                                    AÑADIR
                                                </a>
                                                <a href="{{ route('productos.disminuirStock', ['id_pro' => $paginacion->id_pro]) }}" class="btn btn-sm btn-danger">
                                                    RETIRAR
                                                </a>
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                                @csrf
                                              
                                                </form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                
                                </tbody>
                            
                            </table>
                        </div>
                    </div>
                </div>
                {!! $productos->links() !!}
            </div>
        </div>
    </div>

@endsection
