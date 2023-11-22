@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="box box-info padding-1">
    <div class="box-body" >
    
        <div class="form-group">
            {{ Form::label('Producto') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_pro', $productos->nombre_pro, ['class' => 'form-control' . ($errors->has('nombre_pro') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del Producto']) }}
            {!! $errors->first('nombre_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group"><div style="margin-top:1%; "></div>
            {{ Form::label('Descripcion') }}<div style="margin-bottom:1%; "></div>
            {{ Form::text('descripcion_pro', $productos->descripcion_pro, ['class' => 'form-control' . ($errors->has('descripcion_pro') ? ' is-invalid' : ''), 'placeholder' => 'Agregue una descripcion del producto']) }}
            {!! $errors->first('descripcion_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group"><div style="margin-top:1%; "></div>
            {{ Form::label('Cantidad') }}<div style="margin-bottom:1%;"></div>
            {{ Form::number('cantidad_pro', $productos->cantidad_pro, ['class' => 'form-control' . ($errors->has('cantidad_pro') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la cantidad']) }}
            {!! $errors->first('cantidad_pro', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group"><div style="margin-top:1%; "></div>
            {{ Form::label('Categoria') }}<div style="margin-bottom:1%;"></div>
            {{ Form::select('categorias_id_cat', $categorias , $productos->categorias_id_cat, ['class' => 'form-control' . ($errors->has('categorias_id_cat') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la categoría del producto']) }}
            {!! $errors->first('categorias_id_cat', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group"><div style="margin-top:1%; "></div>
            {{ Form::label('Marca') }}<div style="margin-bottom:1%;"></div>
            {{ Form::select('marcas_id_mar', $marcas , $productos->marcas_id_mar, ['class' => 'form-control' . ($errors->has('marcas_id_mar') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la marca del producto']) }}
            {!! $errors->first('marcas_id_mar', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <!--ACÁ VA LA CONDICIONAL QUE ESTÁ EN EL BORRADOR-->
        <div class="form-group"><div style="margin-top:1%; "></div>
            {{ Form::label('Modelo') }}<div style="margin-bottom:1%;"></div>
            {{ Form::select('modelos_id_mod', $modelos , $productos->modelos_id_mod, ['class' => 'form-control' . ($errors->has('modelos_id_mod') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el modelo de la marca']) }}
            {!! $errors->first('modelos_id_mod', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20" style="margin-top:2%">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>