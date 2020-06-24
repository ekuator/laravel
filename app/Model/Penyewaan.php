<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        'id_buku', 'jml_hari', 'tgl_sewa', 'tgl_kembali', 'total_biaya',
    ];
}
