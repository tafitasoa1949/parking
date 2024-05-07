<!-- Temps Field -->
<div class="col-sm-12">
    {!! Form::label('temps', 'Temps:') !!}
    <p>{{ $tarif->debut }}</p>
</div>

<!-- Prix Field -->
<div class="col-sm-12">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $tarif->prix }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $tarif->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $tarif->updated_at }}</p>
</div>

