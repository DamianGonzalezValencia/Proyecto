<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::model($modelos, ['route' => ['modelos.update', $modeos->id_mod], 'method' => 'PATCH']) }}

        <div class="form-group">
            {{ Form::label('nombre_mod', 'Nombre del Modelo') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_mod', null, ['class' => 'form-control' . ($errors->has('nombre_mod') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Modelo']) }}
            {!! $errors->first('nombre_mod', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        {{ Form::submit('Actualizar', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>
