<?php

namespace App\Controllers;

use App\Models\SuratOut;
use App\Models\SuratIn;
use CodeIgniter\Database\Database;

class Home extends BaseController
{
    public function __construct()
    {
        $this->dbin = new SuratIn();
        $this->dbout = new SuratOut();
        session();
        helper('cookie');
    }

    //HALAMAN AWAL
    public function index()
    {          
        if(get_cookie('nama') != null and !isset($_SESSION['nama']))
        {
            return redirect()->to('login/logincookie');
        }
        else if(!isset($_SESSION['nama']))
        {
            return redirect()->to('login');
        }

        $query1 = $this->dbin->get();
        $query2 = $this->dbout->get();

        $hasil1 = $query1->getNumRows();
        $hasil2 = $query2->getNumRows();

        $data['hslIn'] =  $hasil1;
        $data['hslOut'] =  $hasil2;

        return view('home', $data);
    }

    //HALAMAN ABOUT
    public function about()
    {
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to('/login');
        }
        
        return view('about');
    }
}
