@extends('layouts.app')

@section('template_title')
    {{ __('AumentarStock') }} Producto
@endsection

@section('content')

    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12" style="margin-top:2%">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Aumento de Stock') }} </span>
                    </div>
                    <div class="card-body">
                         <form method="POST" action="{{ route('productos.aumentarStock', $productos->id_pro) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos.formupdatemas')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
