<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Station extends Model
{
    use HasFactory;
    public $table = 'station';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'parking_id',
        'voiture_id',
        'duree_estime',
        'dateheure',
        'etat_id'
    ];
    public static function getId(){
        return DB::select("SELECT gen_station_id()")[0]->gen_station_id;
    }
    public function voiture(){
        return $this->belongsTo(voiture::class,'voiture_id');
    }
    public function parking(){
        return $this->belongsTo(parking::class,'parking_id');
    }
    public function etat(){
        return $this->belongsTo(etat::class,'etat_id');
    }
    public function getStationnement(){
        $result = DB::select('select * from stationnement');
        return $result;
    }

}
