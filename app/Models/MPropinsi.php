<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits;

class MPropinsi extends Model
{
    use HasFactory, UuidTraits;

    protected $table = 'tbl_provinsi';
    protected $primaryKey = 'id_provinsi';

    protected $fillable = [
        'nama_provinsi',
    ];
}
