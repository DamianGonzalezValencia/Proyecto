@extends('layouts.app')
<title>Detalles Movimientos</title>
@section('template_title')
    {{ $movimientos->name ?? "{{ __('Show') Movimientos" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div class="float">
                            <span class="card-title">{{ __('DETALLES') }} PRODUCTO</span>
                            <a class="btn btn-primary" style="margin-left:20px" href="{{ route('movimientos.index') }}"> {{ __('VOLVER') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Movimiento:</strong>
                            {{ $movimientos->id_mov }}
                        </div>
                        <div class="form-group">
                            <strong>Producto:</strong>
                            {{ $movimientos->nombre_mov }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $movimientos->descripcion_pa_movimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $movimientos->categoria_pa_movimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Marca:</strong>
                            {{ $movimientos->marca_pa_movimiento }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
