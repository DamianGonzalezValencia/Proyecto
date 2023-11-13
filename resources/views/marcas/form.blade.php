<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre_mar') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_mar', $marcas->nombre_mar, ['class' => 'form-control' . ($errors->has('nombre_mar') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Mar']) }}
            {!! $errors->first('nombre_mar', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20" style="margin-top:2%">
        <button type="submit" class="btn btn-primary">{{ __('GUARDAR') }}</button>
    </div>
</div>