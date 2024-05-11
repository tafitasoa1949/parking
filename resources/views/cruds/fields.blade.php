<!-- Nom Field -->
<div class="form-group">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control']) !!}
    @error('nom')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('datenaissance', 'Date de naissace:') !!}
    {!! Form::date('datenaissance', null, ['class' => 'form-control']) !!}
    @error('datenaissance')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Genre Field -->
<div class="form-group ">
    {!! Form::label('genre_id', 'Genre:')!!}
    {!! Form::select('genre_id', $genres->pluck('sexe', 'id')->toArray(), null, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
    @error('genre_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Diplome Field -->
<div class="form-group clearfix">
    {!! Form::label('diplome_id', 'Diplome:')!!}
    @foreach($diplomes as $diplome)
        <div class="form-check form-check-inline">
            {!! Form::checkbox('diplome_id[]', $diplome->id, false, ['class' => 'form-check-input'])!!}
            <label class="form-check-label" for="diplome_id-{{ $diplome->id }}">{{ $diplome->nom }}</label>
        </div>
    @endforeach
    @error('diplome_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Amoureuse Field -->
<div class="form-group clearfix">
    {!! Form::label('amoureuse_id', 'Situation amoureuse:')!!}
    @foreach($amoureuses as $amoureuse)
        <div class="form-check">
            {!! Form::radio('amoureuse_id', $amoureuse->id, false, ['class' => 'form-check-input'])!!}
            <label class="form-check-label" for="amoureuse_id-{{ $amoureuse->id }}">{{ $amoureuse->situation }}</label>
        </div>
    @endforeach
    @error('amoureuse_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- Url photo Field -->
<div class="form-group">
    <label for="customFile">Photo</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile" name="url_photo" accept=".png,.jpg,.jpeg">
        <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    @error('url_photo')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
</div>



