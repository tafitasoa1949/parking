<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $etat->code }}</p>
</div>

<!-- Couleur Field -->
<div class="col-sm-12">
    {!! Form::label('couleur', 'Couleur:') !!}
    <p>{{ $etat->couleur }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $etat->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $etat->updated_at }}</p>
</div>

