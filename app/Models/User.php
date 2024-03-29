<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LaravelEntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'full_name',
        'address',
        'identify_number',
        'home_town',
        'residence',
        'phone',
        'email',
        'birthday',
        'password',
        'note',
        'card_front',
        'card_back',
        'province',
        'district',
        'ward',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function toKhai()
    {
        return $this->hasMany(ToKhai::class);
    }

    public function dangKyTiemChung()
    {
        return $this->hasMany(DangKyTiemChung::class);
    }

    public function lichSuTiemChung()
    {
        return $this->hasMany(LichSuTiemChung::class);
    }

    public function  healthTrack()
    {
        return $this->hasMany(HealthTrack::class);
    }

    public function patienInformation () {
        return $this->hasMany(PatientInformation::class);
    }

    public static function getUserByID($id)
    {
        return User::findOrFail($id);
    }

    public static function getCheckPatientInforByUserID($id)
    {
        return PatientInformation::with('user')->where('user_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
