<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amoureuse extends Model
{
    use HasFactory;
    public $table = 'amoureuse';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $fillable = [
        'situation'
    ];
}
