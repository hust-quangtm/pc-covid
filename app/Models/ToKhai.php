<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToKhai extends Model
{
    use HasFactory;

    protected $table = 'to_khai';

    protected $fillable = [
        'user_id',
        'transportations',
        'transportations_identify',
        'departure_place',
        'arrival_place',
        'departure_date',
        'pass_country',
        'pass_country_note',
        'has_signal',
        'signal_note',
        'has_patient',
        'has_from_sick_country',
        'has_sick',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getInfoByUserID($user_id)
    {
        return ToKhai::where('user_id', $user_id) ->orderBy('created_at', 'desc')->get();
    }

    public static function getInfoByID($id)
    {
        return ToKhai::findOrFail($id);
    }
}
