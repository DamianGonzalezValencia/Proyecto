

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
        {{ Form::model($productos, ['route' => ['productos.update', $productos->id_pro], 'method' => 'PATCH']) }}
            <div class="col-md-6">
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
        <div class="col-md-6" style="padding-right:25%; margin-top:3%">
            <div class="box-body">

                <div class="form-group"><div style="margin:1%;"></div>
                    {{ Form::label('Ingrese cantidad a Retirar') }}<div style="margin-bottom:1%;"></div>
                    {{ Form::number('cantidad_pro', '', ['class' => 'form-control' . ($errors->has('cantidad_pro') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la cantidad']) }}
                    {!! $errors->first('cantidad_pro', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div style="margin-top:4%">
                    {!! Form::open(['route' => ['productos.prestamosProductos', $productos->id_pro], 'method' => 'PATCH']) !!}
                        {{ Form::submit('REALIZAR PRÉSTAMO', ['class' => 'btn btn-warning']) }}
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
