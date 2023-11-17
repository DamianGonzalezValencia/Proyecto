@extends('layouts.app')
<title>Marcas</title>
@section('template_title')
    Marca
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('MARCAS') }}
                            </span>

                             <div class="float-right" style="padding-right:4%">
                                <a href="{{ route('marcas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('CREAR NUEVA MARCA') }}
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
                                        
										<th>Id Marca</th>
										<th>Nombre Marcas</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marcas as $paginacion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paginacion->id_mar }}</td>
											<td>{{ $paginacion->nombre_mar }}</td>

                                            <td>
                                                <form action="{{ route('marcas.destroy',$paginacion->id_mar) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('marcas.show',$paginacion->id_mar) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER DETALLES') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('marcas.edit',$paginacion->id_mar) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
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
                {!! $marcas->links() !!}
            </div>
        </div>
    </div>
@endsection
