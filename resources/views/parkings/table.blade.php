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
                <td style="text-align: center"><a class="btn btn-info btn-sm" href="{{ route('enstation', [$parking->id]) }}" style="margin-right: 10px;">Stationner</a></td>
                @endif
                <td>
                    {!! Form::open(['route' => ['parkings.destroy', $parking->id], 'method' => 'delete'])!!}
                    <div class='btn-group'>
                        <a class="btn btn-success btn-sm" href="{{ route('parkings.show', [$parking->id]) }}" style="margin-right: 10px;">
                            <i class="fas fa-eye"></i>
                            View
                        </a>
                        @if(Session::get('profil_id') == 1)
                        <a class="btn btn-warning btn-sm" href="{{ route('parkings.edit', [$parking->id]) }}" style="margin-right: 10px;">
                            <i class="far fa-edit"></i>
                            Edit
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"])!!}
                        @endif
                    </div>
                    {!! Form::close()!!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    @include('adminlte-templates::common.paginate', ['records' => $parkings])
</div>
