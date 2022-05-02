<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthTrack extends Model
{
    use HasFactory;

    protected $table = 'health_tracks';

    protected $fillable = [
        'user_id',
        'declaration_date',
        'session_of_day',
        'pulse',
        'daily_temperature',
        'breathing_rate',
        'spo2',
        'maximum_blood_pressure',
        'minimum_blood_pressure',
        'no_symptoms',
        'tired',
        'cough',
        'productive_cough',
        'chills',
        'conjuntivitis',
        'loss_of_taste_or_smell',
        'diarrhea',
        'hemoptisi',
        'difficulty_breathing',
        'chest_tightness',
        'not_awake',
        'note',
        'doctor_note'
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public static function getInforByUserId ()
    {
        return HealthTrack::with('user')->get();
    }

    public static function getInforById ($id)
    {
        return HealthTrack::findOrFail($id);
    }
}
