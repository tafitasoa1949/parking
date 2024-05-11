<!-- Code Field -->
<div class="form-group ">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::number('code', null, ['class' => 'form-control']) !!}
    @error('code')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Couleur Field -->
<div class="form-group ">
    {!! Form::label('couleur', 'Couleur:')!!}
    {!! Form::select('couleur', ['red' => 'Red', 'blue' => 'Bleu', 'green' => 'Green'], null, ['class' => 'form-control'])!!}
    @error('couleur')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<!-- Action Field -->
<div class="form-group ">
    {!! Form::label('action', 'Action:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
    @error('action')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
