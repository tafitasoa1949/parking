<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stationnement extends Model
{
    use HasFactory;
    public $table = 'stationnement';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'user_id',
        'parking_id',
        'voiture_id',
        'duree_estime',
        'dateheure',
        'etat_id',
        'datesortie',
        'duree_reel',
        'amende',
        'montant'
    ];
    public function voiture(){
        return $this->belongsTo(voiture::class,'voiture_id');
    }
    public function parking(){
        return $this->belongsTo(parking::class,'parking_id');
    }
    public function etat(){
        return $this->belongsTo(etat::class,'etat_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
