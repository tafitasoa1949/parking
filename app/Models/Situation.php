<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;
    public $table = 'entre_parking';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'numero',
        'etat_id',
        'heure_arrive',
        'duree_estime'
    ];
    public function etat(){
        return $this->belongsTo(etat::class,'etat_id');
    }
    public function parking(){
        return $this->belongsTo(parking::class,'id');
    }
}
