@extends('layouts.app')
<title>Movimientos</title>
@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container-fluid" style="height:100%">
        <div class="row" style="height:100%">
            <div class="col-sm-12" style="margin-top:2%; height:100%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('PRODUCTOS') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('INGRESAR UN PRODUCTO') }}
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
                        @if ($productos)
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>
                                        
										<th>Id Producto</th>
										<th>Nombre de Producto</th>
                                        <th>Cantidad</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $paginacion)
                                        <tr>                                        
                                            @php 
                                                $i = 0; 
                                            @endphp
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paginacion->id_pro }}</td>
											<td>{{ $paginacion->nombre_pro }}</td>
                                            <td>{{ $paginacion->cantidad_pro }}</td>
                                            <td>{{ $paginacion->categoria->nombre_cat }}</td><!-- PUEDE QUE HAYA QUE SOLO QUITAR LA LETRA "S" -->
                                            <td>{{ $paginacion->marca->nombre_mar }}</td>

                                            <td>
                                                <form action="{{ route('productos.destroy',$paginacion->id_pro) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('productos.show',$paginacion->id_pro) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER DETALLES') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit',$paginacion->id_pro) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('RETIRAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        @else
                            <p>No hay productos disponibles.</p>
                        @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
