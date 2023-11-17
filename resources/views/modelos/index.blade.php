@extends('layouts.app')
<title>Modelos</title>
@section('template_title')
    Modelo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('MODELOS') }}
                            </span>

                             <div class="float-right" style="padding-right:4%">
                                <a href="{{ route('modelos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('CREAR NUEVO MODELO') }}
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
                                        
										<th>Id Modelo</th>
										<th>Nombre Modelos</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modelos as $paginacion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paginacion->id_mod }}</td>
											<td>{{ $paginacion->nombre_mod }}</td>

                                            <td>
                                                <form action="{{ route('modelos.destroy',$paginacion->id_mod) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('modelos.show',$paginacion->id_mod) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER DETALLES') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('modelos.edit',$paginacion->id_mod) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
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
                {!! $modelos->links() !!}
            </div>
        </div>
    </div>
@endsection
