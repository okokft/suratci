<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratIn extends Model
{
    protected $table            = 'surat_in';
    protected $allowedFields    = ['no_surat', 'tgl_masuk', 'tgl_surat', 'perihal', 'asal', 'akses', 'nama_gbr'];
}
