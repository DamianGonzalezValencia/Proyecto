<div class="box box-info padding-1">
    <div class="box-body" >
    
        <div class="form-group" >
            {{ Form::label('nombre_cat') }}<div style="margin-bottom:1%;"></div>
            {{ Form::text('nombre_cat', $categorias->nombre_cat, ['class' => 'form-control' . ($errors->has('nombre_cat') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cat']) }}
            {!! $errors->first('nombre_cat', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20" style="margin-top:1.5%">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>