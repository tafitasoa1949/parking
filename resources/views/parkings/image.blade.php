@extends('layouts.menu')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Huhu Huhu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Listes des parkings
                                </h3>
                                <a href="{{ route('parkings.create') }}" style="display: block; float: right;width: 80px" class="btn btn-block bg-gradient-primary btn-sm">Ajouter</a>
                            </div>
                            <div class="card-body pad table-responsive">
                                <table class="table table-bordered text-center">
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach($situation as $index => $site)
                                        @if($count >= 5)
                                            @php
                                                $count = 0;
                                            @endphp
                                            <tr>
                                                <td colspan="100%"></td>
                                            </tr>
                                        @endif
                                        <td>
                                            @if($site->etat->code == 0)
                                                <button
                                                    class="btn btn-app parking-link show-modal-on-click"
                                                    style="background-color: {{ $site->etat->couleur }} ; color: white"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="N° : {{ $site->numero }}
Etat : {{ $site->etat->action }}"
                                                    data-content=""
                                                    data-html="true"
                                                    onclick="modalClick('{{$site->id}}')">
                                                    <span class="badge bg-success">{{ $count }}</span>
                                                    <i class="fas fa-car"></i> {{ $site->numero }}
                                                </button>
                                            @else
                                                @php
                                                    $dureeEstime = new DateTime($site->duree_estime);
                                                    $heures = $dureeEstime->format('H');
                                                    $minutes = $dureeEstime->format('i');
                                                    $secondes = $dureeEstime->format('s');
                                                 @endphp
                                                <button
                                                    class="btn btn-app parking-link show-modal-on-click"
                                                    style="background-color: {{ $site->etat->couleur }} ; color: white"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="N° : {{ $site->numero }}
Etat : {{ $site->etat->action }}
Heure d'arrivée : {{ $site->heure_arrive }}
Durée de stationnement : {{ $heures }} h {{ $minutes }} min {{ $secondes }} seconde(s)"
                                                    data-content=""
                                                    data-html="true">
                                                    <span class="badge bg-success">{{ $count }}</span>
                                                    <i class="fas fa-car"></i> {{ $site->numero }}
                                                </button>
                                            @endif
                                        </td>
                                        @php
                                            $count++;
                                        @endphp
                                    @endforeach
                                </table>
                                <div class="modal fade" id="parkingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="parkingDetailsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="parkingDetailsModalLabel">Faire une reservation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('stationner') }}" method="post">
                                                    @csrf
                                                    <h3>Information de la voiture</h3>
                                                    <input type="texte" name="parking_id" id="parking_id" value="">
                                                    <div class="form-group">
                                                        <label>Numero</label>
                                                        <input type="text" class="form-control" name="numero" >
                                                        @error('numero')
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
                                                        @error('marque_id')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Longueur</label>
                                                        <input type="number" step="any" class="form-control" name="longueur" >
                                                        @error('longueur')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Largeur</label>
                                                        <input type="number" step="any" class="form-control" name="largeur" >
                                                        @error('largeur')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <h3>Je stationne</h3>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Date et heure d'arrivé</label>
                                                        <input type="datetime-local" step="any" class="form-control" id="exampleInputEmail1" placeholder="En minute" name="dateheure">
                                                        @error('dateheure')
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
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Reserver</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Etat de stationnement
                                </h3>
                            </div>
                            <div class="card-body">
                                <p>Nombre de parking total : {{{ count($situation) }}}</p>
                                <hr>
                                <h4 style="text-align: center;">Statut des places</h4>
                                <div class="card-body">
                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        $(function () {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var stat_etat_parking = {!! json_encode($stat_etat_parking) !!};
            console.log(stat_etat_parking);
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
                labels: stat_etat_parking.map(function(etat) {
                    return etat.action;
                }),
                datasets: [
                    {
                        data: stat_etat_parking.map(function(etat) {
                            return etat.nombre;
                        }),backgroundColor: stat_etat_parking.map(function(etat) {
                            return etat.couleur;
                        }),
                    }
                ]
            }
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }

            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })


        })
    </script>

    <script>
        function modalClick(id) {
            console.log(id); // Affiche l'id dans la console
            var parking_id = document.getElementById('parking_id');
            parking_id.value = id;
            // Supposons que vous ayez un modal avec l'ID 'parkingDetailsModal'
            $('#parkingDetailsModal').modal('show'); // Affiche le modal
        }
    </script>

@endsection
