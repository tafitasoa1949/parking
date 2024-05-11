<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    public $table = 'genre';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $fillable = [
        'sexe'
    ];
}
