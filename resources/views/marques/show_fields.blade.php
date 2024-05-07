<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $marque->nom }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $marque->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $marque->updated_at }}</p>
</div>

