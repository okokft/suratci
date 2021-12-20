<?php

namespace App\Controllers;

use App\Models\SuratOut;
use App\Models\SuratIn;
use CodeIgniter\Database\Database;

class Home extends BaseController
{
    //HALAMAN AWAL
    public function index()
    {
        $session = session();
        helper("cookie");
        
        
        if(get_cookie('nama') != null and !isset($_SESSION['nama']))
        {
            return redirect()->to('login/logincookie');
        }
        else if(!isset($_SESSION['nama']))
        {
            return redirect()->to('login');
        }

        $dbin = new SuratIn();
        $dbout = new SuratOut();

        $query1 = $dbin->get();
        $query2 = $dbout->get();

        $hasil1 = $query1->getNumRows();
        $hasil2 = $query2->getNumRows();

        $data['hslIn'] =  $hasil1;
        $data['hslOut'] =  $hasil2;

        return view('home', $data);
    }
}
