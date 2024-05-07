<!-- Numero Field -->
<div class="form-group">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
</div>

<!-- Longueur Field -->
<div class="form-group ">
    {!! Form::label('longueur', 'Longueur:') !!}
    {!! Form::number('longueur', null, ['class' => 'form-control', 'required', 'maxlength' => 100,'set' => 'any']) !!}

<!-- Largeur Field -->
<div class="form-group ">
    {!! Form::label('largeur', 'Largeur:') !!}
    {!! Form::number('largeur', null, ['class' => 'form-control', 'required', 'maxlength' => 100,'set' => 'any']) !!}
</div>
