<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class voiture extends Model
{
    public $table = 'voiture';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $fillable = [
        'user_id',
        'marque_id',
        'numero',
        'longueur',
        'largeur'
    ];

    protected $casts = [
        'marque_id' => 'string',
        'numero' => 'string',
        'longueur' => 'double',
        'largeur' => 'double'
    ];

    public static array $rules = [
        'marque_id' => 'required',
        'longueur' => 'required',
        'largeur' => 'required'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public static function getId(){
        return DB::select("SELECT gen_voiture_id()")[0]->gen_voiture_id;
    }
}
