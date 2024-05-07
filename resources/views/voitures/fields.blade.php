<!-- Marque Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('marque_id', 'Marque Id:') !!}
    {!! Form::select('marque_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Longueur Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longueur', 'Longueur:') !!}
    {!! Form::number('longueur', null, ['class' => 'form-control']) !!}
</div>