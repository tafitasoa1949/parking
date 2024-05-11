<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompteRequest;
use App\Models\Depot;
use DateTime;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    //
    public function depot(){
        $user_id = session('user_id');
        $solde = Depot::getSolde($user_id);
        $depot = Depot::where('user_id', $user_id)
            ->where('action','0')
            ->orderBy('date', 'desc')
            ->get();
        return view('compte.liste',[
            'depot' => $depot,
            'solde' => $solde
        ]);
    }
    public function ajouter(){
        $user_id = session('user_id');
        $solde = Depot::getSolde($user_id);
        return view('compte.depot',[
            'solde' => $solde
        ]);
    }
    public function depot_argent(CompteRequest $request){
        $dateString = $request->date;
        $dateTime = new DateTime($dateString);
        $formattedDate = $dateTime->format('Y-m-d H:i:s');
        $user_id = session('user_id');
        $depot = new Depot();
        $depot->id = Depot::getId();
        $depot->user_id = $user_id;
        $depot->solde = $request->montant;
        $depot->date = $formattedDate;
        $depot->save();
        return redirect()->route('depot');
    }
    public function listeDepot(){
        $depotNonValider = Depot::where('etat','0')
            ->where('action',0)
            ->get();
        return view('compte.tous',[
            'depotNonValider' => $depotNonValider
        ]);
    }
    public function validation($id){
        $depot = Depot::find($id);
        $depot->etat=10;
        $depot->save();
        return redirect()->route('depot.tous');
    }
}
