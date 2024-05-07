<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $parking->numero }}</p>
</div>

<!-- Lieu Field -->
<div class="col-sm-12">
    {!! Form::label('longueur', 'Longueur:') !!}
    <p>{{ $parking->longueur }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('largeur', 'Largeur:') !!}
    <p>{{ $parking->largeur }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $parking->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $parking->updated_at }}</p>
</div>

