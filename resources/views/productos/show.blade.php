@extends('layouts.app')

@section('template_title')
    {{ $productos->name ?? "{{ __('Show') Productos" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div class="float">
                            <span class="card-title">{{ __('DETALLES') }} PRODUCTO</span>
                            <a class="btn btn-primary" style="margin-left:20px" href="{{ route('productos.index') }}"> {{ __('VOLVER') }}</a>
                            <a class="btn btn-success"  href="{{route('productos.edit',$productos->id_pro) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>  
                            <a href="{{ route('productos.disminuirStock', ['id_pro' => $productos->id_pro]) }}" class="btn btn-danger">RETIRAR</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Producto:</strong>
                            {{ $productos->id_pro }}
                        </div>
                        <div class="form-group">
                            <strong>Producto:</strong>
                            {{ $productos->nombre_pro }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $productos->descripcion_pro }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $productos->cantidad_pro }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $productos->categoria->nombre_cat }}
                        </div>
                        <div class="form-group">
                            <strong>Marca:</strong>
                            {{ $productos->marca->nombre_mar }}
                        </div>
                        <div class="form-group">
                            <strong>Modelo:</strong>
                            {{ $productos->modelo->nombre_mod }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
