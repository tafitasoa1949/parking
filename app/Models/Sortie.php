<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sortie extends Model
{
    use HasFactory;
    public $table = 'sortie';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $fillable = [
        'id',
        'station_id',
        'duree_reel',
        'dateheure',
        'montant'
    ];
    public static function getId(){
        return DB::select("SELECT gen_sortie_id()")[0]->gen_sortie_id;
    }
    public function station(){
        return $this->belongsTo(Station::class,'station_id');
    }
    public static function getIntervalHeureMinSec($datetime1, $datetime2) {
        $interval = $datetime1->diff($datetime2);
        $totalHours = $interval->days * 24 + $interval->h;
        $totalMinutes = $interval->i;
        $totalSeconds = $interval->s;
        while ($totalMinutes >= 60) {
            $totalHours++;
            $totalMinutes -= 60;
        }
        while ($totalSeconds >= 60) {
            $totalMinutes++;
            $totalSeconds -= 60;
        }
        $formattedDuration = sprintf("%02d:%02d:%02d", $totalHours, $totalMinutes, $totalSeconds);
        return $formattedDuration;
    }

    public static function getIntervalInHours($datetime1, $datetime2) {
        $interval = $datetime1->diff($datetime2);
        $totalHours = $interval->days * 24 + $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;
        $minutes += floor($seconds / 60);
        $totalHours += $minutes / 60;
        $minutes %= 60;
        $formattedHours = number_format($totalHours, 2);
        return $formattedHours;
    }

}
