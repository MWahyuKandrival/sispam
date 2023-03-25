<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'id_transaksi';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    // protected $guarded = ['id_transaksi'];

    protected $fillable = [
        'id_transaksi',
        'id_user',
        'id_pelanggan',
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

    public function Mesin()
    {
        return $this->belongsTo(Mesin::class, "id_pelanggan");
    }
}
