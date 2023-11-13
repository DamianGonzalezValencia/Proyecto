@extends('layouts.app')
<title>Home</title>
<div>
@section('content')
<div class="container">
    <div class="justify-content-center" style="margin-left:9%">
        <div class="col-md-9" style="height: responsive">
            
            <div class="card " style="margin-top:6%">
                <div class="card-header">{{ __('PANEL DE ACCIONES') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <td > BIENVENIDO  : <span class="large-text" style="font-size:121%">{{ Auth::user()->name }}</span></td>


                </div>
            </div>

        <div class="card mb-9" style="margin-top: 9%">
            <div class="card-header">INFORMACIONES</div>
            <div class="card-body">
                <h5 class="card-title">Productos sin Marca o Categoría</h5>
                <p class="card-text">Para los productos que no entren en ninguna categoría o no tengan marca, existe un campo por para cada exepcion,
                    "OTRA MARCA" para productos sin marca y "NO APLICA" para productos sin una categoria específica.
                </p>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
@endsection


  