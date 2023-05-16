<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    // protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'id_user',
        'id_pelanggan',
        'tanggal',
        'biaya_perkubik',
        'biaya_admin',
        'pemakaian',
        'total_tagihan',
        'total_pembayaran',
        'status',
    ];

    public function Petugas()
    {
        return $this->belongsTo(User::class, "id_user");
    }

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "id_pelanggan");
    }

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class, "id_pemakaian");
    }
}
