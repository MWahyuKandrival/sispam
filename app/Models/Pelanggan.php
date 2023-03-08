<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    // protected $guarded = ['id_pelanggan'];

    protected $fillable = [
        'id',
        'name',
        'alamat',
        'no_telp',
        'status',
        'kode_mesin',
        'id_user',
    ];

    public function getRouteKeyName()
    {
        return 'id_pelanggan';
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, "id_pelanggan");
    }

    public function currentTransaksi()
    {
        return $this->hasMany(Transaksi::class, "id_pelanggan")->whereMonth("created_at", now()->month)->orWhere("status", "Hutang")->whereYear("created_at", now()->year);
    }

    public function whereTransaksi($data)
    {
        return $this->hasMany(Transaksi::class, "id_pelanggan")->whereMonth("created_at", $data->month)->whereYear("created_at", $data->year);
    }
}
