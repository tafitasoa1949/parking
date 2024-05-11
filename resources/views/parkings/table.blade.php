<div class="card-header">
    <h3 class="card-title">Parkings</h3>
    <a href="{{ route('parkings.create') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
</div>


<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Longueur</th>
            <th>Largeur</th>
            @if(Session::get('profil_id') == 2)
            <th></th>
            @endif
            <th style="width: 240px"></th>
        </tr>
        </thead>
        <tbody>
                @foreach($parkings as $parking)
                    <tr>
                        <td>{{ $parking->numero }}</td>
                        <td>{{ $parking->longueur }} metres</td>
                        <td>{{ $parking->largeur }} metres</td>
                        @if(Session::get('profil_id') == 2)
                            <td style="text-align: center">
                                <a class="btn btn-info btn-sm" href="{{ route('enstation', [$parking->id]) }}" style="margin-right: 10px;">Stationner</a>
                                <!-- Popup pour les détails du parking -->
                                <div id="popup-{{ $parking->id }}" class="popup-details" style="display:none;">
                                    <!-- Contenu du popup ici -->
                                    <p>Détails du parking {{ $parking->numero }}</p>
                                </div>
                            </td>
                        @endif
                        <!-- Le reste de votre code... -->
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    @include('adminlte-templates::common.paginate', ['records' => $parkings])
</div>
