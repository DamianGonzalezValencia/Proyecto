<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre_mod') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_mod', $modelos->nombre_mod, ['class' => 'form-control' . ($errors->has('nombre_mod') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del Modelo']) }}
            {!! $errors->first('nombre_mod', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20" style="margin-top:2%">
        <button type="submit" class="btn btn-primary">{{ __('GUARDAR') }}</button>
    </div>
</div>