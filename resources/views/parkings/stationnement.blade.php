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
                        <h1 class="m-0"> Stationnement</h1>
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
                                <h5 class="card-title">Historique de votre stationement</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Parking</th>
                                        <th>Duree estime</th>
                                        <th>Duree réel</th>
                                        <th>Date d'arrivé</th>
                                        <th>Date depart</th>
                                        <th>Amende</th>
                                        <th>Montant total</th>
                                        <th style=""></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stationnement as $st)
                                        <tr>
                                            <td>{{ $st->voiture->numero }}</td>
                                            <td>{{ $st->parking->numero }}</td>
                                            <td>{{ $st->duree_estime }} heure(s)</td>
                                            <td>{{ $st->duree_reel? $st->duree_reel. ' heure(s)' : '' }}</td>
                                            <td>{{ $st->dateheure }}</td>
                                            <td>{{ $st->datesortie }}</td>
                                            <td>{{ $st->amende }} Ar</td>
                                            <td>{{ $st->amende+$st->montant }} Ar</td>
                                            <td>
                                                @if($st->etat->code == 10)
{{--                                                    <a class="btn btn-sm btn-warning" href="{{ route('sortie', [$st->id]) }}" style="margin-right: 10px;">--}}
{{--                                                        <i class="fas fa-eye"></i>--}}
{{--                                                        Enlever--}}
{{--                                                    </a>--}}
                                                    <a  onclick="openFormPopup('{{ $st->id }}')" class="btn btn-sm btn-warning" href="#" style="margin-right: 10px;">
                                                        <i class="fas fa-eye"></i>
                                                        Enlever
                                                    </a >

                                                @elseif($st->etat->code == 0)
                                                    <a class="btn btn-sm btn-success" href="{{ route('facturer', [$st->id]) }}" style="margin-right: 10px;">
                                                        <i class="fas fa-eye"></i>
                                                        Facturer
                                                    </a>
                                                @else
                                                    <!-- Ajoutez ici le texte à afficher pour d'autres états si nécessaire -->
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @error('error')
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h4>{{ $message }}</h4>
                                        </div>
                                    </div>
                                @enderror
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
    <!-- Modal -->
    <div class="card-body">
        <button class="btn btn-primary" onclick="openFormPopup()">Faire un bon de reception</button>
    </div>
    <div id="overlay">
        <div id="popup">
            <span id="closeBtn" class="bold-label" onclick="closeFormPopup()">X</span>
            <label  class="bold-label" >Sortie</label>
            <form id="myForm" method="post" action="{{ route('sortie') }}">
                @csrf
                <div class="form-group col-12">
                    <label for="date">Date</label>
                    <input type="datetime-local" class="form-control" id="date" name="date" required>
                    <div id="error-message" style="color: red;"></div>
                </div>
                <input type="submit" class="btn btn-success" value="Valider">
            </form>
        </div>
    </div>
    <script>
        function openFormPopup(id) {
           // console.log(idhoe);
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'station_id';
            input.value = id;
            var myForm = document.getElementById('myForm');
            myForm.appendChild(input);
            document.getElementById('overlay').style.display = 'flex';
        }

        function closeFormPopup() {
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
@endsection
