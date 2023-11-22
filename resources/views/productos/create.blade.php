@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:2%">

                @includeif('partials.errors')

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('INGRESO DE') }} PRODUCTO</span>
                    </div>
                    <div class="card-body" >
                        <form method="POST" action="{{ route('productos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('productos.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
