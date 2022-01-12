<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SuratOut;
use CodeIgniter\Database\Query;

class Surat_Out extends BaseController
{
    public function __construct()
    {
        $this->db = new SuratOut();
        session();
        helper('html');
    }

    //MENAMPILKAN HALAMAN SURAT KELUAR
    public function index($tahun)
    {
        if(!isset($_SESSION['nama']))
        {
            return redirect()->to('/login');
        }

        $tahunawal = 2021;
        $tahunsekarang = date('Y');

        session()->set(['tahun' => $tahun]);

        $datanya = [
            'tahunawal' => $tahunawal,
            'tahunsekarang' => $tahunsekarang,
            'tahun' => $tahun
        ];

        return view('out/suratout', $datanya);
    }

    //AJAX TABLE
    public function ajax_out()
    {
        $this->db->orderBy('YEAR(tgl_surat)', 'DESC');
        $this->db->orderBy('no_urut', 'DESC');
        // if(session('akses') != "administrator" and session('akses') != "agendaris")
        // {
        //     $this->db->where(['akses' => "accept"]);
        // }
        $this->db->where(['YEAR(tgl_surat)' => session('tahun')]);

        $query = $this->db->findAll();

        $data = [];
        $no = 0;
        $dispo = ['agendaris', 'KADIS', 'Accept'];

        foreach($query as $d)
        {
            $gbr = '';
            $btngambar = '';
            $btnedit = '';
            $btnhapus = '';
            $btndispo = '';
            $btndetail = '<a href="'.base_url('/suratout/detail/').'/'.$d['id'] .'" class="dropdown-item">Detail</a>';

            //Menampilkan tombol Lihat Gambar
            if($d['nama_gbr'] != null)
            {
                $gbr = '<i class="far fa-file"></i></td>';
                $btngambar = '<a href="'. base_url('/suratout/lihatgbr/').'/'.$d['id'] .'" class="dropdown-item">Lihat Gambar</a>';
            }

            //Menampilkan Tombol Edit dan Hapus yg hanya bisa admin
            if (session('level') == "agendaris" or session('level') == "kadis" or session('level') == "administrator")
            {
                $btnedit = '<a href="'. base_url('/suratout/edit/').'/'.$d['id'] .'" class="dropdown-item">Edit</a>';
                $btnhapus = '<form method="POST" action="'. base_url('/Surat_Out/hapus').'/'.$d['id'] .'">
                                <input type="submit" class="dropdown-item" value="Hapus" onclick="return hapus()"></button>
                            </form>';
            }

            //Tombol Disposisi
            if(session('level') == "administrator" or session('level') == "agendaris" )
            {
                $daftardispo = '<a href="'.base_url('/suratout/disposisi/').'/'.$d['id'].'/'.$dispo[0] .'" class="dropdown-item">'.$dispo[0] .'</a>
                                <a href="'.base_url('/suratout/disposisi/').'/'.$d['id'].'/'.$dispo[1] .'" class="dropdown-item">'.$dispo[1] .'</a>
                                <a href="'.base_url('/suratout/disposisi/').'/'.$d['id'].'/'.$dispo[2] .'" class="dropdown-item">'.$dispo[2] .'</a>
                                ';
                $btndispo = '<div class="btn-group" >
                            <button type="button "class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Disposisi</button>
                            <div class="dropdown-menu scrollable-menu" style="height: auto; max-height: 100px; overflow-x: hidden; overflow-y: auto">    
                            '.$daftardispo.'
                            ';
            }
            else if (session('level') == "kadis")
            {
                $daftardispo = '<a href="'.base_url('/suratout/disposisi/').'/'.$d['id'].'/'.$dispo[0] .'" class="dropdown-item">'.$dispo[0] .'</a>
                                <a href="'.base_url('/suratout/disposisi/').'/'.$d['id'].'/'.$dispo[2] .'" class="dropdown-item">'.$dispo[2] .'</a>
                                ';
                $btndispo = '<div class="btn-group" >
                            <button type="button "class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Disposisi</button>
                            <div class="dropdown-menu scrollable-menu" style="height: auto; max-height: 100px; overflow-x: hidden; overflow-y: auto">    
                            '.$daftardispo.'
                            ';
            }

            $no++;
            $row = array();
            $row['no'] = $no;
            $row['no_surat'] = $d['no_surat'].' <p><b>'.$d['akses'].'</b></p>';
            $row['perihal'] = $d['perihal'].' '.$gbr;
            $row['tgl_surat'] = $d['tgl_surat'];
            $row['tujuan'] = $d['tujuan'];
            $row['aksi'] = '<div class="btn-group">
                                <div class="btn-group">                          
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Aksi</button>
                                    <div class="dropdown-menu" style="height: auto; max-height: 100px; overflow-x: hidden; overflow-y: auto">
                                        '.$btndetail.''.$btnedit.''.$btnhapus.''.$btngambar.'
                                    </div>
                                </div>
                            '.$btndispo.'
                            </div>
                            </div>
                            </div>
                            ';

            $data[] = $row;
        }
        $output = array(
            "data" => $data
        );

        echo json_encode($output);
    }

    //DETAIL
    public function detail($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        $datanya = [
            'data' => $query
        ];

        return view('out/detailout', $datanya);
    }

    //EDIT
    public function edit($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        $datanya = [
            'data' => $query
        ];

        return view('out/editout', $datanya);
    }
    public function simpanedit()
    {
        $id = $this->request->getVar('id');
        $no_urut = explode("/", $this->request->getVar('no_surat'));
        $no_urutnya = $no_urut[1];

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'no_urut' => $no_urutnya,
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'tujuan' => $this->request->getVar('tujuan'),
                'ket_disposisi' => $this->request->getVar('ket_disposisi')
            ];
            
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();

        return redirect()->to('/suratout/'.session('tahun'));
    }

    //HAPUS
    public function hapus($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        if($query['nama_gbr'] != null){
            $namagbr = $query['nama_gbr'];
            unlink('file/'.$namagbr);
        }

        $this->db->delete(['id' => $id]);

        return redirect()->to('/suratout/'.session('tahun'));
    }

    //TAMBAH SURAT
    public function tambah()
    {
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

        $this->db->insert($data);

        return redirect()->to('/suratout/'.session('tahun'));
    }

    //DISPOSISI
    public function dispo($id,$ds)
    {
        $this->db->set('akses', $ds);
        $this->db->where('id', $id);
        $this->db->update();

        return redirect()->to('/suratout/'.session('tahun'));
    }

    //LIHAT GAMBAR
    public function lihatgbr($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        $namagbr = $query['nama_gbr'];
        $pathinfo = pathinfo('file/'.$namagbr, PATHINFO_EXTENSION);

        $data =
        [
            'namagbr' => $namagbr,
            'pathinfo' => $pathinfo
        ];

        return view('lihatgbr', $data);
    }
}
