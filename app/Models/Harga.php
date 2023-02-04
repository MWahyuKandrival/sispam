<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    public function getRouteKeyName()
    {
        return 'id';
    }

    protected $guarded = ['id', 'nama_harga'];
    
    protected $fillable = [
        'harga',
        'keterangan',
    ];
}
