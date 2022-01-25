<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuTiemChung extends Model
{
    use HasFactory;

    protected $table = 'lich_su_tiem_chung';

    protected $fillable = [
        'user_id',
        'vaccine_name',
        'ordinal_of_injection',
        'date_of_injection',
        'injection_address',
        'last_lot_vaccine_nummber',
        'note',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public static function getInforByUserId ()
    {
        return LichSuTiemChung::with('user')->get();
    }
}
