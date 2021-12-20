<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratIn;
use CodeIgniter\Database\Database;

class Surat_In extends BaseController
{
    // HALAMAN AWAL
    public function index()
    {
        $session = session();
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to('/login');
        }

        $dbin = new SuratIn();
        $query1 = $dbin->orderBy('id', 'DESC')->findAll();

        if(session('akses') == "administrator" or session('akses') == "agendaris")
        {
            $dispo = ['agendaris', 'KADIS', 'sekdin', 'kabidp2', 'kabidsdk', 'kabidkesmas', 'kabidyankes', 'p2pm', 'p2ptm', 'surveilans', 'sdmk', 'farmasi', 'alkes', 'promkes', 'kesling', 'kgm', 'primer', 'kestrad', 'rujukan', 'piep', 'keuangan', 'up', 'ifk', 'labkesda'];
        }
        else if(session('akses') == "KADIS")
        {
            $dispo = ['agendaris', 'Sekdin', 'kabidp2', 'kabidsdk', 'kabidkesmas', 'kabidyankes', 'ifk', 'labkesda'];
        }
        else if(session('akses') == "sekdin")
        {
            $dispo = ['piep', 'keuangan', 'up'];
        }
        else if(session('akses') == "kabidp2")
        {
            $dispo = ['p2pm', 'p2ptm', 'surveilans'];
        }
        else if(session('akses') == "kabidsdk")
        {
            $dispo = ['sdmk', 'farmasi', 'alkes'];
        }
        else if(session('akses') == "kabidkesmas")
        {
            $dispo = ['promkes', 'kesling', 'kgm'];
        }
        else if(session('akses') == "kabidyankes")
        {
            $dispo = ['primer', 'kestrad', 'rujukan'];
        }
        else{
            $dispo = [];
        }

        $data = [
            'datadbin' => $query1,
            'dispo' => $dispo
        ];

        return view('suratin', $data);
    }

    //DETAIL
    public function detail($id)
    {
        $dbin = new SuratIn();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('detailin', $datanya);
    }

    //EDIT
    public function edit($id)
    {
        $dbin = new SuratIn();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('editin', $datanya);
    }
    public function simpanedit()
    {
        $dbin = new SuratIn();
        $id = $this->request->getVar('id');

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'asal' => $this->request->getVar('asal'),
                'ket_disposisi' => $this->request->getVar('ket_disposisi')
            ];
            
        $dbin->set($data);
        $dbin->where('id', $id);
        $dbin->update();

        return redirect()->to('/suratin');
    }

    //HAPUS
    public function hapus($id)
    {
        $dbin = new SuratIn();
        $query1 = $dbin->delete(['id' => $id]);

        return redirect()->to('/suratin');
    }

    //TAMBAH SURAT
    public function tambah()
    {
        $dbin = new SuratIn();

        $file = $this->request->getFile('gbr');

        $name = $file->getRandomName();

        $file->move('file',$name);    

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'tgl_masuk' => $this->request->getVar('tgl_masuk'),
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'asal' => $this->request->getVar('asal'),
                'akses' => $this->request->getVar('akses'),
                'nama_gbr' => $name
            ];

        $dbin->insert($data);

        return redirect()->to('/suratin');
    }

    //DISPOSISI
    public function disposisi()
    {
        $dbin = new SuratIn();

        $disposisi = $this->request->getVar('dispo');
        $id = $this->request->getVar('id_surat');

        $dbin->set('akses', $disposisi);
        $dbin->where('id', $id);
        $dbin->update();

        return redirect()->to('/suratin');
    }
}
