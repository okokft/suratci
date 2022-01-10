<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\SuratOut;
use App\Models\SuratIn;

class Login extends BaseController
{
    public function __construct()
    {
        $this->dbin = new SuratIn();
        $this->dbout = new SuratOut();
        $this->users = new Users();
        session();
        helper('cookie');
    }

    //HALAMAN AWAL
    public function index()
    {
        $query1 = $this->dbin->get();
        $query2 = $this->dbout->get();

        $hasil1 = $query1->getNumRows();
        $hasil2 = $query2->getNumRows();

        $data['hslIn'] =  $hasil1;
        $data['hslOut'] =  $hasil2;

        return view('login', $data);
    }

    //CEK USERNAME DAN PASSWORD
    public function ceklogin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $query = $this->users->where(['username' => $username, 'password' => $password])->first();
        
        if($query > 0)
        {
            $data = 
            [
                'nama' => $query['nama'],
                'akses' => $query['akses'],
                'level' => $query['level']
            ];
            session()->set($data);
            
            return redirect()->to('/home/index')->setCookie('nama', $query['nama'], '86400')->send();
        }
        else{
            session()->setFlashdata(array('pesan' => "gagal1"));
            return redirect()->to('login');
        }
    }

    //LOGIN JIKA MASIH ADA COOKIE
    public function logincookie()
    {
        $nama = get_cookie('nama');

        $query = $this->users->where(['nama' => $nama])->first(); 
        
        if($query > 0)
        {
            $data = 
            [
                'nama' => $query['nama'],
                'akses' => $query['akses'],
                'level' => $query['level']
            ];

            session()->set($data);
            
            return redirect()->to('/home/index');
        }
        else{
            session()->setFlashdata(array('pesan' => "gagal2"));
            return redirect()->to('login');
        }
    }

    //LOGOUT
    public function logout()
    {
        delete_cookie('name');
        session()->destroy();
        return redirect()->to('/login/index')->deletecookie('nama')->send();
    }
}
