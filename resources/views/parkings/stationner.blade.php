@extends('layouts.menu')
@section('content')
    {{-- content --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Parking</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Parking</a></li>
                            <li class="breadcrumb-item active">Stationner</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Je stationne</h5>
                            </div>
                            {{-- form --}}
                            <form action="{{ route('stationner') }}" method="post">

                                @csrf
                                <input type="hidden" name="parking_id" value="{{ $parking_id }}">
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <div class="card-body">
                                    <h3>Information sur la voiture</h3>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Numero</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Numero" name="numero">
                                        @error('nom')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Marques</label>
                                        <select class="form-control select2" style="width: 100%;" name="marque_id">
                                            @foreach($marques as $marque)
                                                <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Longueur</label>
                                        <input type="number" step="any" class="form-control" id="exampleInputEmail1" placeholder="En metres" name="longueur">
                                        @error('longueur')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Largeur</label>
                                        <input type="number" step="any" class="form-control" id="exampleInputEmail1" placeholder="En metres" name="largeur">
                                        @error('largeur')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <h3>Durée de la station</h3>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date et heure d'arrivé</label>
                                        <input type="datetime-local" step="any" class="form-control" id="exampleInputEmail1" placeholder="En minute" name="dateheure">
                                        @error('duree')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Durée</label>
                                        <input type="time" step="any" class="form-control" id="exampleInputEmail1" placeholder="En minute" name="duree">
                                        @error('duree')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            {{--  --}}
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    {{--  --}}
@endsection
