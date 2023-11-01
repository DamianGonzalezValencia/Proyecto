<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::model($categorias, ['route' => ['categorias.update', $categorias->id_cat], 'method' => 'PATCH']) }}

        <div class="form-group">
            {{ Form::label('nombre_cat', 'Nombre de la categoría') }}
            {{ Form::text('nombre_cat', null, ['class' => 'form-control' . ($errors->has('nombre_cat') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cat']) }}
            {!! $errors->first('nombre_cat', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        {{ Form::submit('Actualizar', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
</div>
