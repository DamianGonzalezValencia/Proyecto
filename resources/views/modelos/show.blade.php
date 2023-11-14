@extends('layouts.app')

@section('template_title')
    {{ $modelos->name ?? "{{ __('Show') Modelo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Modelo</span>
                            <a class="btn btn-primary" style="margin-left:20px"href="{{ route('modelos.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Modelo:</strong>
                            {{ $modelos->id_mod }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Modelo:</strong>
                            {{ $modelos->nombre_mod }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
