<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;

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

    public function getRouteKeyName()
    {
        return 'id';
    }

    // protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'name',
        'email',
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
        return $this->hasMany(Pelanggan::class, "id_user")->where("status", "Active");
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, "id_user");
    }

    public function currentTransaksi()
    {
        return $this->hasMany(Transaksi::class, "id_user")->whereMonth("created_at", now()->month)->whereYear("created_at", now()->year);
    }

    public function whereTransaksi($data)
    {
        return $this->hasMany(Transaksi::class, "id_user")->whereMonth("created_at", $data->month)->whereYear("created_at", $data->year);
    }
}
