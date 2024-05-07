<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class marque extends Model
{
    public $table = 'marque';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $fillable = [
        'id',
        'nom'
    ];

    protected $casts = [
        'nom' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required'
    ];
    public static function getId(){
        return DB::select("SELECT gen_marque_id()")[0]->gen_marque_id;
    }

}
