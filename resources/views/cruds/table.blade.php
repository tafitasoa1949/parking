<div class="card-header">
    <h3 class="card-title">CRUD</h3>
    <a href="{{ route('cruds.create') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
</div>


<!-- /.card-header -->
<div class="card-body">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Genre</th>
            <th>Diplome</th>
            <th>Situation (A)</th>
            <th>URL photo</th>
            <th style="width: 240px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($cruds as $crud)
            <tr>
                <td>{{ $crud->nom }}</td>
                <td>{{ $crud->datenaissance }}</td>
                <td>{{ $crud->genre->sexe }}</td>
                <td>{{ $crud->diplome->nom }}</td>
                <td>{{ $crud->amoureuse->situation }}</td>
                <td>{{ $crud->url_photo }}</td>
                <td>
                    {!! Form::open(['route' => ['cruds.destroy', $crud->id], 'method' => 'delete'])!!}
                    <div class='btn-group'>
                        <a class="btn btn-warning btn-sm" href="{{ route('cruds.edit', [$crud->id]) }}" style="margin-right: 10px;">
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
    @include('adminlte-templates::common.paginate', ['records' => $cruds])
</div>
