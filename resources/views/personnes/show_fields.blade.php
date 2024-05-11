<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $personne->nom }}</p>
</div>

<!-- Age Field -->
<div class="col-sm-12">
    {!! Form::label('age', 'Age:') !!}
    <p>{{ $personne->age }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $personne->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $personne->updated_at }}</p>
</div>

