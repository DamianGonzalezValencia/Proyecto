@extends('layouts.app')

@section('template_title')
    {{ $categorias->name ?? "{{ __('Show') Categoria" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Categoria</span>
                            <a class="btn btn-primary" style="margin-left:20px" href="{{ route('categorias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Cat:</strong>
                            {{ $categorias->id_cat }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Cat:</strong>
                            {{ $categorias->nombre_cat }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
