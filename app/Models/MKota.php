<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MKota extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_kota';
    protected $primaryKey = 'id_kota';

    protected $fillable = [
        'nama_kota',
    ];
}
