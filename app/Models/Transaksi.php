<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // if your key name is not 'id'
    // you can also set this to null if you don't have a primary key
    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $fillable = [
        'id_pemakaian',
        'total_pembayaran',
        'created_by',
    ];
}
