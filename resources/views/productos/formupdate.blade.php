<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::model($productos, ['route' => ['productos.update', $productos->id_pro], 'method' => 'PATCH']) }}

        <div class="form-group">
            {{ Form::label('nombre_pro', 'Nombre del Producto') }}
            {{ Form::text('nombre_pro', null, ['class' => 'form-control' . ($errors->has('nombre_pro') ? ' is-invalid' : ''), 'placeholder' => 'Producto']) }}
            {!! $errors->first('nombre_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_pro', 'Descripcion') }}
            {{ Form::text('descripcion_pro', null, ['class' => 'form-control' . ($errors->has('descripcion_pro') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad_pro', 'Cantidad de Productos') }}
            {{ Form::number('cantidad_pro', null, ['class' => 'form-control' . ($errors->has('cantidad_pro') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <!-- CATEGORIAS -->
        <div class="form-group">
            {{ Form::label('Categoria') }}
            {{ Form::select('categorias_id_cat', $categorias , $productos->categorias_id_cat, ['class' => 'form-control' . ($errors->has('categorias_id_cat') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la categoría del producto']) }}
            {!! $errors->first('categorias_id_cat', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <!-- MARCAS -->
        <div class="form-group">
            {{ Form::label('Marca') }}
            {{ Form::select('marcas_id_mar', $marcas, $productos->marcas_id_mar, ['class' => 'form-control' . ($errors->has('marcas_id_mar') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la marca del producto']) }}
            {!! $errors->first('marcas_id_mar', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
    <div class="box-footer mt20">
        {{ Form::submit('Actualizar', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>