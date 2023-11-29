@extends('layouts.app')
<title>Home</title>
<div>
@section('content')
<div class="container">
    <div class="justify-content-center" style="margin-left:9%">
        <div class="col-md-11" style="height: responsive">
            
            <div class="card " style="margin-top:5%">
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

        <div class="card mb-9" style="margin-top: 5%">
            <div class="card-header">INFORMACIONES</div>
            <div class="card-body">
            <h5 class="card-title">Productos sin Marca, Categoría o Modelo</h5>
                <p class="card-text">Para los productos que no entren en ninguna categoría o no tengan marca, existe un campo por para cada exepcion,
                    "OTRA MARCA" para productos sin Marca y "NO APLICA" para productos sin una Categoría específica o Modelo.
                </p>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        STOCKS MÁS BAJOS
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        </div>
                        <ul>
                            @foreach ($stockProductos as $productos)
                                <li >
                                    {{ $productos->nombre_pro }} - Cantidad: {{ $productos->cantidad_pro }} - Descripcion: {{ $productos->descripcion_pro }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        STOCKS POR CATEGORÍA
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <ul>
                        @foreach ($categorias as $categorias)
                            <li>
                                {{ $categorias->nombre_cat }}: {{ $categorias->productos_count }}
                            </li>
                        @endforeach
                    </ul>
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        STOCKS POR MARCA
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <ul>
                        @foreach ($marcas as $marcas)
                            <li>
                                {{ $marcas->nombre_mar }}: {{ $marcas->productos_count }}
                            </li>
                        @endforeach
                    </ul>                    
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
@endsection
                <!--<h5 class="card-title">Productos sin Marca o Categoría</h5>
                <p class="card-text">Para los productos que no entren en ninguna categoría o no tengan marca, existe un campo por para cada exepcion,
                    "OTRA MARCA" para productos sin marca y "NO APLICA" para productos sin una categoria específica.
                </p>-->

  