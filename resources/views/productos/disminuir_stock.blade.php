@extends('layouts.app')

@section('template_title')
    {{ __('DisminuirStock') }} Producto
@endsection

@section('content')

    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12" style="margin-top:2%">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Retirar Producto') }} </span>
                        <a class="btn btn-primary" style="margin-left:20px" href="{{ route('productos.index') }}"> {{ __('VOLVER') }}</a>
                     
                    </div>
                    <div class="card-body">
                         <form method="POST" action="{{ route('productos.retirarProductos', $productos->id_pro) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos.formupdatemenos')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection


