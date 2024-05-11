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
                        <h1 class="m-0"> Compte</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Parking</a></li>
                            <li class="breadcrumb-item active">Depot</li>
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
                                <h5 class="card-title">Depot d'argent</h5>
                            </div>
                            {{-- form --}}
                            <form action="{{ route('depot_argent') }}" method="post">

                                @csrf
                                <div class="card-body">
                                    <h3>Depot d'argent</h3>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Montant</label>
                                        <input type="number" step="any" class="form-control" id="exampleInputEmail1" placeholder="" name="montant">
                                        @error('montant')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date</label>
                                        <input type="datetime-local" class="form-control" id="exampleInputEmail1" name="date">
                                        @error('date')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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
