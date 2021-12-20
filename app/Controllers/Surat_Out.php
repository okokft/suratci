<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Surat_Out extends BaseController
{
    public function index()
    {
        $session = session();
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to('/login');
        }

        return view('suratout');
    }
}
