@extends('layouts.app')
<title>Movimientos</title>
@section('template_title')
    Movimiento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('HISTORIAL DE RETIROS, INGRESOS Y CAMBIOS') }}
                            </span>
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
                                        <th style="width:11%; text-align:center">Id Mov.</th>
                                        <th style="width:14%">Tipo </th>
                                        <th style="width:11%; text-align:center">Cantidad</th>
                                        <th style="width:11%">Fecha</th>
                                        <th>Producto</th>
                                        <th>Usuario</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientos as $paginacion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td style="text-align:center">{{ $paginacion->id_mov }}</td>
                                            <td style="width:14%">{{ $paginacion->tipo_mov }}</td>
                                            <td style="text-align:center; width:11%" >{{ $paginacion->cantidad_mov }}</td>
                                            <td>{{ $paginacion->fecha_mov }}</td>
                                            <td>{{ $paginacion->nombre_mov }}</td>
                                            <td>{{ $paginacion->user->name }}</td>
                                            <td>
                                                <form>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('movimientos.show', $paginacion->id_mov)}}" style="min-width: 60px; padding-top: 7px;">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
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
                {!! $movimientos->links() !!}
            </div>
        </div>
    </div>
@endsection
