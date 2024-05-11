<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    public $table = 'crud';

    public $fillable = [
        'nom',
        'datenaissance',
        'genre_id',
        'diplome_id',
        'amoureuse_id',
        'url_photo'
    ];

    protected $casts = [
        'nom' => 'string',
        'datenaissance' => 'datetime',
        'genre_id' => 'integer',
        'diplome_id' => 'integer',
        'amoureuse_id' => 'integer',
        'url_photo' => 'string'
    ];

    public static $rules = [
        'nom' => 'required',
        'datenaissance' => 'required|date|before:tomorrow',
        'genre_id' => 'required|integer',
        'diplome_id' => 'required',
        'amoureuse_id' => 'required|integer',
        'url_photo' => 'required'
    ];


    public static $messages = [
        'nom.required' => 'Le nom est obligatoire.',
        'datenaissance.required' => 'La date de naissance est obligatoire.',
        'datenaissance.date' => 'La date de naissance doit être une date valide.',
        'datenaissance.before' => 'La date de naissance ne peut pas être dans le futur.',
        'genre_id.required' => 'Le genre est obligatoire.',
        'diplome_id.required' => 'Le diplôme est obligatoire.',
        'amoureuse_id.required' => 'La situation amoureuse est obligatoire.',
        'url_photo.required' => 'Une photo est requise.',
    ];



    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id');
    }
    public function diplome(){
        return $this->belongsTo(Diplome::class,'diplome_id');
    }
    public function amoureuse(){
        return $this->belongsTo(Amoureuse::class,'amoureuse_id');
    }

}
