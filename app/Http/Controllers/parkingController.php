<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateparkingRequest;
use App\Http\Requests\UpdateparkingRequest;
use App\Models\Amende;
use App\Models\marque;
use App\Models\parking;
use App\Models\Sortie;
use App\Models\Station;
use App\Models\Stationnement;
use App\Models\tarif;
use App\Models\voiture;
use App\Repositories\parkingRepository;
use \DateTime;
use Illuminate\Http\Request;
use Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class parkingController extends AppBaseController
{
    /** @var parkingRepository $parkingRepository*/
    private $parkingRepository;

    public function __construct(parkingRepository $parkingRepo )
    {
        $this->parkingRepository = $parkingRepo;
    }

    /**
     * Display a listing of the parking.
     */
    public function index(Request $request)
    {
        $parkings = $this->parkingRepository->paginate(2);

        return view('parkings.index')
            ->with('parkings', $parkings);
    }

    /**
     * Show the form for creating a new parking.
     */
    public function create()
    {
        return view('parkings.create');
    }

    /**
     * Store a newly created parking in storage.
     */
    public function store(CreateparkingRequest $request)
    {
        $input = $request->all();
        $input['id'] = Parking::getId();
        $parking = $this->parkingRepository->create($input);

        Flash::success('Parking saved successfully.');

        return redirect(route('parkings.index'));
    }

    /**
     * Display the specified parking.
     */
    public function show($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        return view('parkings.show')->with('parking', $parking);
    }

    /**
     * Show the form for editing the specified parking.
     */
    public function edit($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        return view('parkings.edit')->with('parking', $parking);
    }

    /**
     * Update the specified parking in storage.
     */
    public function update($id, UpdateparkingRequest $request)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        $parking = $this->parkingRepository->update($request->all(), $id);

        Flash::success('Parking updated successfully.');

        return redirect(route('parkings.index'));
    }

    /**
     * Remove the specified parking from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $parking = $this->parkingRepository->find($id);

        if (empty($parking)) {
            Flash::error('Parking not found');

            return redirect(route('parkings.index'));
        }

        $this->parkingRepository->delete($id);

        Flash::success('Parking deleted successfully.');

        return redirect(route('parkings.index'));
    }
    public function enstation($id){
        $user_id = session('user_id');
        return view('parkings.stationner',[
            'parking_id' => $id,
            'marques' => marque::all(),
            'user_id' => $user_id
        ]);
    }
    public function stationner(Request $request){
        DB::beginTransaction();
        try {
            $numero = $request->numero;
            $voiture = voiture::where('numero', $numero)->first();
            if(!$voiture){
                $voiture = new voiture();
                $voiture->id = voiture::getId();
                $voiture->marque_id = $request->marque_id;
                $voiture->numero = $numero;
                $voiture->longueur = $request->longueur;
                $voiture->largeur = $request->largeur;
                $voiture->save();
            }
//            $dateArrivee = Carbon::parse('2024-05-09 10:00:00');
//            $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
//            //dd($dateEtHeureActuellesMadagascar);
//            if ($dateArrivee->gt($dateEtHeureActuellesMadagascar)) {
//                return redirect()->back()->withErrors(['error' => "Heure invalide, dépasse l'heure actuelle"]);
//            }
            $station = new Station();
            $station->id = Station::getId();
            $station->user_id = $request->user_id;
            $station->parking_id = $request->parking_id;
            $station->voiture_id = $voiture->id;
            $station->duree_estime = $request->duree;
            $station->dateheure = $request->dateheure;
            $station->save();
            DB::commit();
            return redirect()->route('parkings.index');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            // Vous pouvez également enregistrer l'erreur ou la renvoyer à l'utilisateur
            //return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'insertion.']);
        }
    }
    public function stationnement(){
        $user_id = session('user_id');
        $stationnement = Stationnement::where('user_id',$user_id)->get();
        return view('parkings.stationnement',[
            'stationnement' => $stationnement
        ]);
    }
//    public function sortie($id){
//        DB::beginTransaction();
//        try {
//            $station = Station::find($id);
//            $dateArrivee = new DateTime($station->dateheure);
//            $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
//            $dateheureactuel = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
//            $dateActuelle = new DateTime($dateheureactuel);
//            $duree_reel = Sortie::getIntervalInHours($dateArrivee,$dateActuelle);
//            $heureMinSec = Sortie::getIntervalHeureMinSec($dateArrivee,$dateActuelle);
//            //dd($heureMinSec);
//            $tarif = tarif::getByheure($duree_reel);
//            //dd($tarif);
//            $tarif_payer = $tarif->prix * $duree_reel;
//            $sortie = new Sortie();
//            $sortie->id = Sortie::getId();
//            $sortie->station_id = $station->id;
//            $sortie->duree_reel = $duree_reel;
//            $sortie->dateheure = $dateheureactuel;
//            $sortie->montant = $tarif_payer;
//            //dd($station->duree_estime);
//            //amende
//            if($station->duree_estime < $heureMinSec){
//                $amende = Amende::all()[0];
//                //$tarif_payer += $amende->tarif;
//                $sortie->amende = $amende->tarif;
//            }
//            $sortie->save();
//            $station->etat=10;
//            $station->save();
//            DB::commit();
//            return redirect()->route('stationnement');
//        }catch(\Exception $e){
//            DB::rollBack();
//            dd($e);
//            // Vous pouvez également enregistrer l'erreur ou la renvoyer à l'utilisateur
//            //return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'insertion.']);
//        }
//    }
    public function sortie(Request $request){
        //dd($request->all());
        return redirect()->route('stationnement');
//        DB::beginTransaction();
//        try {
//            $station = Station::find($id);
//            $dateArrivee = new DateTime($station->dateheure);
//            $dateEtHeureActuellesMadagascar = Carbon::now('Indian/Antananarivo');
//            $dateheureactuel = $dateEtHeureActuellesMadagascar->format('Y-m-d H:i:s');
//            $dateActuelle = new DateTime($dateheureactuel);
//            $duree_reel = Sortie::getIntervalInHours($dateArrivee,$dateActuelle);
//            $heureMinSec = Sortie::getIntervalHeureMinSec($dateArrivee,$dateActuelle);
//            //dd($heureMinSec);
//            $tarif = tarif::getByheure($duree_reel);
//            //dd($tarif);
//            $tarif_payer = $tarif->prix * $duree_reel;
//            $sortie = new Sortie();
//            $sortie->id = Sortie::getId();
//            $sortie->station_id = $station->id;
//            $sortie->duree_reel = $duree_reel;
//            $sortie->dateheure = $dateheureactuel;
//            $sortie->montant = $tarif_payer;
//            //dd($station->duree_estime);
//            //amende
//            if($station->duree_estime < $heureMinSec){
//                $amende = Amende::all()[0];
//                //$tarif_payer += $amende->tarif;
//                $sortie->amende = $amende->tarif;
//            }
//            $sortie->save();
//            $station->etat=10;
//            $station->save();
//            DB::commit();
//            return redirect()->route('stationnement');
//        }catch(\Exception $e){
//            DB::rollBack();
//            dd($e);
//            // Vous pouvez également enregistrer l'erreur ou la renvoyer à l'utilisateur
//            //return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'insertion.']);
//        }
    }
    public function facturer($id){
        $stationnement  = Stationnement::find($id);
        $data = array(
            'stationnement' => $stationnement
        );
        $pdf = PDF::loadView('pdf.facture', $data);
        return $pdf->download('facture.pdf');
    }
}
