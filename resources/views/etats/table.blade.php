<div class="card-header">
    <h3 class="card-title">Etats</h3>
    <a href="{{ route('etats.create') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
</div>


<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Code</th>
            <th>Couleur</th>
            <th>Action</th>
            <th style="width: 240px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($etats as $etat)
            <tr>
                <td>{{ $etat->code }}</td>
                <td>{{ $etat->couleur }}</td>
                <td>{{ $etat->action }}</td>
                <td>
                    {!! Form::open(['route' => ['etats.destroy', $etat->id], 'method' => 'delete'])!!}
                    <div class='btn-group'>
                        <a class="btn btn-warning btn-sm" href="{{ route('etats.edit', [$etat->id]) }}" style="margin-right: 10px;">
                            <i class="far fa-edit"></i>
                            Edit
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"])!!}
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
    @include('adminlte-templates::common.paginate', ['records' => $etats])
</div>
