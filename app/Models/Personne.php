<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    public $table = 'personne';

    public $fillable = [
        'nom',
        'age'
    ];

    protected $casts = [
        'nom' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required',
        'age' => 'required|integer|min:1'
    ];


}
