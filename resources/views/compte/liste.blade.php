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
                        <h1 class="m-0"> Depot</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Parking</a></li>
                            <li class="breadcrumb-item active">Historique</li>
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
                                <h5 class="card-title">Historique de votre depot</h5>
                                <a href="{{ route('depot.ajouter') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>etat</th>
                                        <th style=""></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($depot as $d)
                                            <tr>
                                                <td>{{ $d->solde }} Ar</td>
                                                <td>{{ $d->date }} Ar</td>
                                                <td>
                                                    @if($d->etat == 0 )
                                                        <a class="btn btn-sm btn-warning"  style="margin-right: 10px;">
                                                            <i class="fas fa-eye"></i>
                                                            Non valider
                                                        </a >
                                                    @elseif($d->etat == 10)
                                                        <a class="btn btn-sm btn-success"  style="margin-right: 10px;">
                                                            <i class="fas fa-eye"></i>
                                                            Valider
                                                        </a>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
