<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class etat extends Model
{
    public $table = 'etat';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public $fillable = [
        'code',
        'couleur',
        'action'
    ];

    protected $casts = [
        'code' => 'integer',
        'couleur' => 'string',
        'action' => 'string'
    ];

    public static array $rules = [
        'code' => 'required|integer|min:0',
        'couleur' => 'required|max:255',
        'action' => 'required|max:255'
    ];

    public static array $messages = [
        'code.required' => 'Le champ code est obligatoire.',
        'code.min' => 'Code doit être positif.',
        'couleur.required' => 'Le champ couleur est obligatoire.',
        'couleur.max' => 'La couleur ne doit pas dépasser 255 caractères.',
        'action.required' => 'Le champ action est obligatoire.',
        'action.max' => 'L\'action ne doit pas dépasser 255 caractères.'
    ];

}
