<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class parking extends Model
{
    public $table = 'parking';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'numero',
        'longueur',
        'largeur'
    ];

    protected $casts = [
        'numero' => 'string',
        'longueur' => 'double',
        'largeur' => 'double'
    ];

    public static array $rules = [
        'numero' => 'required',
        'longueur' => 'required'
    ];
    public static function getId(){
        return DB::select("SELECT gen_parking_id()")[0]->gen_parking_id;
    }
    public function station(){
        return $this->hasMany(Station::class,'parking_id');
    }
    public static function stat_etat_parking(){
        return DB::select("select * from stat_etat_parking");
    }
}
