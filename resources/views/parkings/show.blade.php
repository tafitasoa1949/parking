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
                            <li class="breadcrumb-item active">Details</li>
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
                                <h5 class="card-title">Details</h5>
                                <a href="{{ route('parkings.index') }}" style="display: block; float: right;width: 80px" class="btn btn-default btn-sm">Retour</a>
                            </div>
                            <div class="card-body">
                                @include('parkings.show_fields')
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- /.content -->
    </div>
    <!-- /.content
@endsection
