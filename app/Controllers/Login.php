<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\SuratOut;
use App\Models\SuratIn;

class Login extends BaseController
{
    //HALAMAN AWAL
    public function index()
    {
        $dbin = new SuratIn();
        $dbout = new SuratOut();

        $query1 = $dbin->get();
        $query2 = $dbout->get();

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

        $builder = new Users();

        $query = $builder->where(['username' => $username, 'password' => $password])->first();
        
        if($query > 0)
        {
            $session = session();
            helper('cookie');

            $data = 
            [
                'nama' => $query['nama'],
                'akses' => $query['akses'],
                'level' => $query['level']
            ];

            $session->set($data);
            
            return redirect()->to('/home/index')->setCookie('nama', $query['nama'], '86400')->send();
        }
        else{
            session();
            session()->setFlashdata(array('pesan' => "gagal1"));

            return redirect()->to('login');
        }
    }

    //LOGIN JIKA MASIH ADA COOKIE
    public function logincookie()
    {
        helper('cookie');
        $builder = new Users();

        $nama = get_cookie('nama');

        $query = $builder->where(['nama' => $nama])->first(); 
        
        if($query > 0)
        {
            $session = session();

            $data = 
            [
                'nama' => $query['nama'],
                'akses' => $query['akses'],
                'level' => $query['level']
            ];

            $session->set($data);
            
            return redirect()->to('/home/index');
        }
        else{
            session();
            session()->setFlashdata(array('pesan' => "gagal2"));

            return redirect()->to('login');
        }
    }

    //LOGOUT
    public function logout()
    {
        helper('cookie');
        session()->destroy();

        return redirect()->to('/login/index')->deletecookie('nama')->send();
    }
}
