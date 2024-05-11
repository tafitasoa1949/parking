<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required']) !!}
    @error('nom')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::number('age', null, ['class' => 'form-control', 'required', 'min' => 1]) !!}
    @error('age')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
