@extends('layouts.app')
<title>Categorias</title>
@section('template_title')
    Categoria
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('CATEGORIAS') }}
                            </span>

                             <div class="float-right" style="padding-right:4%">
                                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('CREAR NUEVA CATEGORIA') }}
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
                                        <th>N°</th>
                                        
										<th>Id Categoria</th>
										<th>Nombre de Categoria</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $paginacion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paginacion->id_cat }}</td>
											<td>{{ $paginacion->nombre_cat }}</td>

                                            <td>
                                                <form action="{{ route('categorias.destroy',$paginacion->id_cat) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('categorias.show',$paginacion->id_cat) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER DETALLES') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorias.edit',$paginacion->id_cat) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $categorias->links() !!}
            </div>
        </div>
    </div>
@endsection
