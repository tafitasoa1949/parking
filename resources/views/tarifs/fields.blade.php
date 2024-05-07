<!-- Temps Field -->
<div class="form-group">
    {!! Form::label('Heure debut', 'Heure debut')!!}
    {!! Form::number('debut', null, [
    'class' => 'form-control',
     'required',
     'step' => 'any'
     ])!!}
    @error('debut')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Temps Field -->
<div class="form-group">
    {!! Form::label('Heure fin', 'Heure fin')!!}
    {!! Form::number('fin', null, [
    'class' => 'form-control',
     'step'=> 'any'
     ])!!}
    @error('fin')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Prix Field -->
<div class="form-group ">
    {!! Form::label('prix', 'Prix:') !!}
    {!! Form::number('prix', null, ['class' => 'form-control', 'required']) !!}
    @error('prix')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

