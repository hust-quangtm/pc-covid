<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model
{
    use HasFactory;

    protected $table = 'patient_informations';

    protected $fillable = [
        'user_id',
        'declaration_date',
        'proof_of_image',
        'confirm_status',
        'infected_day',
        'recovery_day',
        'note',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public static function getInforById ($id)
    {
        return PatientInformation::findOrFail($id);
    }

    public static function getInforByUserId ($user_id) {
        return PatientInformation::with('user')->where('user_id', $user_id)->orderBy('declaration_date', 'DESC')->get();
    }
}
