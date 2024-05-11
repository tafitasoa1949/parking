<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;
    public $table = 'diplome';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $fillable = [
        'nom'
    ];
}
