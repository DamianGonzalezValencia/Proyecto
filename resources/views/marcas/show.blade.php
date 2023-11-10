@extends('layouts.app')

@section('template_title')
    {{ $marcas->name ?? "{{ __('Show') Marca" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Marca</span>
                            <a class="btn btn-primary" style="margin-left:20px"href="{{ route('marcas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Marca:</strong>
                            {{ $marcas->id_mar }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Marca:</strong>
                            {{ $marcas->nombre_mar }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
