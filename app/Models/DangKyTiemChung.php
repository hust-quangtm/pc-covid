<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKyTiemChung extends Model
{
    use HasFactory;

    protected $table = 'dang_ky_tiem_chung';

    protected $fillable = [
        'user_id',
        'ordinal_of_injection',
        'date_of_injection_register',
        'part_of_injection_day',
        'priority_group',
        'injection_address',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getInfoByUserID($user_id)
    {
        return DangKyTiemChung::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }

    public static function getInforByID($id)
    {
        return DangKyTiemChung::findOrFail($id);
    }
}
