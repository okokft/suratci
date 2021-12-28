<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SuratOut;

class Surat_Out extends BaseController
{
    public function index()
    {
        $session = session();
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to('/login');
        }

        $dbin = new SuratOut();

        $dbin->orderBy('tgl_surat', 'DESC');
        $dbin->orderBy('no_urut', 'DESC');

        if(session('akses') != "administrator" and session('akses') != "agendaris")
        {
            $dbin->where(['akses' => session('akses')]);
        }

        $query1 = $dbin->findAll();

        if(session('akses') == "administrator" or session('akses') == "agendaris")
        {
            $dispo = ['agendaris', 'KADIS', 'Accept'];
        }
        else if(session('akses') == "KADIS")
        {
            $dispo = ['agendaris', 'Accept'];
        }
        else
        {
            $dispo = [];
        }

        $data = [
            'datadbout' => $query1,
            'dispo' => $dispo
        ];

        return view('out/suratout', $data);
    }

    //DETAIL
    public function detail($id)
    {
        $dbin = new SuratOut();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('out/detailout', $datanya);
    }

    //EDIT
    public function edit($id)
    {
        $dbin = new SuratOut();
        $query1 = $dbin->where(['id' => $id])->first();

        $datanya = [
            'data' => $query1
        ];

        return view('out/editout', $datanya);
    }
    public function simpanedit()
    {
        $dbin = new SuratOut();
        $id = $this->request->getVar('id');

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'tujuan' => $this->request->getVar('tujuan'),
                'ket_disposisi' => $this->request->getVar('ket_disposisi')
            ];
            
        $dbin->set($data);
        $dbin->where('id', $id);
        $dbin->update();

        return redirect()->to('/suratout');
    }

    //HAPUS
    public function hapus($id)
    {
        $dbin = new SuratOut();

        $query1 = $dbin->where(['id' => $id])->first();

        if($query1['nama_gbr'] != null){
            $namagbr = $query1['nama_gbr'];
            unlink('file/'.$namagbr);
        }

        $dbin->delete(['id' => $id]);

        return redirect()->to('/suratout');
    }

    //TAMBAH SURAT
    public function tambah()
    {
        $dbin = new SuratOut();

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

        $no_urut = explode("/", $this->request->getVar('no_surat'));
        $no_urutnya = $no_urut[1];

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'no_urut' => $no_urutnya,
                'tgl_masuk' => $this->request->getVar('tgl_masuk'),
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'tujuan' => $this->request->getVar('tujuan'),
                'akses' => $this->request->getVar('akses'),
                'nama_gbr' => $name
            ];

        $dbin->insert($data);

        return redirect()->to('/suratout');
    }

    //DISPOSISI
    public function dispo($id,$ds)
    {
        $dbin = new SuratOut();

        $dbin->set('akses', $ds);
        $dbin->where('id', $id);
        $dbin->update();

        return redirect()->to('/suratout');
    }

    //LIHAT GAMBAR
    public function lihatgbr($id)
    {
        helper('html');
        $dbin = new SuratOut();
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
