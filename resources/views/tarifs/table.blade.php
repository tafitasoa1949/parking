<div class="card-header">
    <h3 class="card-title">Parkings</h3>
    @if(Session::get('profil_id') == 1)
    <a href="{{ route('tarifs.create') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
    @endif
</div>


<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Heure debut</th>
            <th>Heure fin</th>
            <th>Prix</th>
            @if(Session::get('profil_id') == 1)
            <th style="width: 240px"></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($tarifs as $tarif)
            <tr>
                <td>{{ $tarif->debut }} heure(s)</td>
                <td>{{ $tarif->fin? $tarif->fin. ' heure(s)' : '' }}</td>
                <td>{{ $tarif->prix }} Ar</td>
                @if(Session::get('profil_id') == 1)
                <td>
                    {!! Form::open(['route' => ['tarifs.destroy', $tarif->id], 'method' => 'delete'])!!}
                    <div class='btn-group'>
                        <a class="btn btn-success btn-sm" href="{{ route('tarifs.show', [$tarif->id]) }}" style="margin-right: 10px;">
                            <i class="fas fa-eye"></i>
                            View
                        </a>
                        <a class="btn btn-warning btn-sm" href="{{ route('tarifs.edit', [$tarif->id]) }}" style="margin-right: 10px;">
                            <i class="far fa-edit"></i>
                            Edit
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"])!!}
                    </div>
                    {!! Form::close()!!}
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
    @include('adminlte-templates::common.paginate', ['records' => $tarifs])
</div>
