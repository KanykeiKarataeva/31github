<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN=0;
    const ROLE_EMPLOYEE=1;
    const ROLE_USER=2;

    public static function getRoles(){
        return[
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_EMPLOYEE => 'Сотрудник',
            self::ROLE_USER => 'Пользователь',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'address',
        'phone_number',
        'email',
        'profile_photo',
        'password',
        'role',
        'passport_back',
        'passport_front',
        'amount_child',
        'deleted',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Child');
    }

    public function group()
    {
        return $this->hasOne('App\Models\Group');
    }
}
