<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tarif extends Model
{
    public $table = 'tarif';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'debut',
        'fin',
        'prix'
    ];

    protected $casts = [
        'debut' => 'double',
        'fin' => 'double',
        'prix' => 'double'
    ];

    public static array $rules = [
        'debut' => 'required|min:1|max:2000',
        'fin' => '',
        'prix' => 'required'
    ];


    public static array $messages = [
        'temps.required' => 'Le champ est obligatoire',
        'prix.required' => 'Le champ prix est obligatoire.',
    ];

    public static function getId(){
        return DB::select("SELECT gen_tarif_id()")[0]->gen_tarif_id;
    }
    public static function getByheure($heure){
        $result = DB::table('tarif')
            ->where('debut', '<', $heure)
            ->orderBy('debut','desc')
            ->limit(1)
            ->first();
        return $result?? null;
    }
}
