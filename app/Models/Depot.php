<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Depot extends Model
{
    use HasFactory;
    public $table = 'depot';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'user_id',
        'solde',
        'date',
        'etat'
    ];
    public static function getId(){
        return DB::select("SELECT gen_depot_id()")[0]->gen_depot_id;
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public static function getSolde($id){
        $sql = "SELECT
        (SELECT SUM(solde) FROM depot WHERE etat = 10 AND action = 0 AND user_id = ?) -
        COALESCE((SELECT SUM(solde) FROM depot WHERE action = 1 AND user_id = ?),0) AS solde";
        $result = DB::select($sql, [$id, $id]);
        return $result[0]->solde;
    }

}
