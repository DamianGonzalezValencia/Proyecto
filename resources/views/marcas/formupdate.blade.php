<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::model($marcas, ['route' => ['marcas.update', $marcas->id_mar], 'method' => 'PATCH']) }}

        <div class="form-group">
            {{ Form::label('nombre_mar', 'Nombre de la Marca') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_mar', null, ['class' => 'form-control' . ($errors->has('nombre_mar') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Marca']) }}
            {!! $errors->first('nombre_mar', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        {{ Form::submit('Actualizar', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>
