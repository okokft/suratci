<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratOut extends Model
{
    protected $table            = 'surat_out';
    protected $allowedFields    = ['no_surat', 'no_urut', 'tgl_masuk', 'tgl_surat', 'perihal', 'tujuan', 'akses', 'nama_gbr'];
}
