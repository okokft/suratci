<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratIn;
use CodeIgniter\Database\Database;
use CodeIgniter\Database\Query;

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

        $dbin->orderBy('id', 'DESC');
        if(session('akses') != "administrator" and session('akses') != "agendaris")
        {
            $dbin->where(['akses' => session('akses')]);
        }
        
        $query1 = $dbin->findAll();

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

        return view('in/suratin', $data);
    }

    //DETAIL
    public function detail($id)
    {
        $dbin = new SuratIn();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('in/detailin', $datanya);
    }

    //EDIT
    public function edit($id)
    {
        $dbin = new SuratIn();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('in/editin', $datanya);
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

        $query1 = $dbin->where(['id' => $id])->first();

        if($query1['nama_gbr'] != null){
            $namagbr = $query1['nama_gbr'];
            unlink('file/'.$namagbr);
        }

        //unlink('file/1640072263_15470ea5ffd16c822d95.pdf');

        $dbin->delete(['id' => $id]);

        return redirect()->to('/suratin');
    }

    //TAMBAH SURAT
    public function tambah()
    {
        $dbin = new SuratIn();
        
        if($this->request->getFile('gbr')->isValid())
        {
            $file = $this->request->getFile('gbr');
            $name = $file->getRandomName();
            $file->move('file',$name);    
        }
        else
        {
            $name = null;
        }

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
    public function dispo($id,$ds)
    {
        $dbin = new SuratIn();

        $dbin->set('akses', $ds);
        $dbin->where('id', $id);
        $dbin->update();

        return redirect()->to('/suratin');
    }

    //LIHAT GAMBAR
    public function lihatgbr($id)
    {
        helper('html');
        $dbin = new SuratIn();
        $query1 = $dbin->where(['id' => $id])->first();

        $namagbr = $query1['nama_gbr'];
        
        $pathinfo = pathinfo('file/'.$namagbr, PATHINFO_EXTENSION);
        //dd($pathinfo);

        $data =
        [
            'namagbr' => $namagbr,
            'pathinfo' => $pathinfo
        ];

        return view('lihatgbr', $data);
    }
}
