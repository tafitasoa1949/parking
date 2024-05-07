<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amende extends Model
{
    use HasFactory;
    public $table = 'amende';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'tarif',
        'date',
    ];
}
