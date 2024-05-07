<!-- Marque Id Field -->
<div class="col-sm-12">
    {!! Form::label('marque_id', 'Marque Id:') !!}
    <p>{{ $voiture->marque_id }}</p>
</div>

<!-- Longueur Field -->
<div class="col-sm-12">
    {!! Form::label('longueur', 'Longueur:') !!}
    <p>{{ $voiture->longueur }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $voiture->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $voiture->updated_at }}</p>
</div>

