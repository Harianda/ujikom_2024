<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTraits; // Jika Anda menggunakan UUID trait

class MCamaba extends Model
{
    use HasFactory;

    protected $table = 'tbl_calon_mahasiswa';


    protected $primaryKey = 'id_calon_mahasiswa';

    protected $fillable = [
        'kode_user',
        'nama_user',
        'alamat_ktp',
        'alamat_sekarang',
        'kecamatan',
        'kabupaten',
        'propinsi',
        'nohp',
        'email',
        'kewarganegaraan',
        'tgl_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'status_menikah',
        'agama',
        'uid',
    ];
    protected $casts = [
        'tgl_lahir' => 'date',
    ];
    //new
}
