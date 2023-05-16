<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    // protected $primaryKey = 'id';
    
    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    
    // protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'status',
        'role',
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

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, "id_user");
    }

    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class, "id_user");
    }

    public function currentPemakaian()
    {
        return $this->hasMany(Pemakaian::class, "id_user")->whereMonth("created_at", now()->month)->whereYear("created_at", now()->year);
    }

    public function wherePemakaian($data)
    {
        return $this->hasMany(Pemakaian::class, "id_user")->whereMonth("created_at", $data->month)->whereYear("created_at", $data->year);
    }
}
