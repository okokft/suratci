<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SuratIn;
use CodeIgniter\Database\Database;
use CodeIgniter\Database\Query;
use PHPUnit\Framework\Constraint\IsEqualIgnoringCase;

use function PHPUnit\Framework\equalToIgnoringCase;

class Surat_In extends BaseController
{
    public function __construct()
    {
        $this->db = new SuratIn();
        session();
        helper('html');
    }

    //HALAMAN AWAL
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

        return view('in/suratin', $datanya);     
    }

    //AJAX TABLE
    public function ajax_in()
    {
        $this->db->orderBy('id', 'DESC');
        // if(session('akses') != "administrator" and session('akses') != "agendaris")
        // {
        //     $this->db->where(['akses' => session('akses')]);
        // }
        $this->db->where(['YEAR(tgl_surat)' => session('tahun')]);
        
        $query = $this->db->findAll();

        $data = [];
        $no = 0;     
        $dispo = ['agendaris', 'arsip', 'KADIS', 'sekdin', 'piep', 'keuangan', 'up', 'kabidp2', 'p2pm', 'p2ptm', 'surveilans', 'kabidsdk', 'sdmk', 'farmasi', 'alkes', 'kabidkesmas', 'promkes', 'kesling', 'kgm', 'kabidyankes', 'primer', 'kestrad', 'rujukan', 'ifk', 'labkesda'];

        foreach($query as $d)
        {
            $gbr = '';
            $btngambar = '';
            $btnedit = '';
            $btnhapus = '';
            $btndispo = '';
            $btndetail = '<a href="'.base_url('/suratin/detail/').'/'.$d['id'] .'" class="dropdown-item">Detail</a>';

            //Menampilkan tombol Lihat Gambar
            if($d['nama_gbr'] != null)
            {
                $gbr = '<i class="far fa-file"></i></td>';
                $btngambar = '<a href="'. base_url('/suratin/lihatgbr/').'/'.$d['id'] .'" class="dropdown-item">Lihat Gambar</a>';
            }

            //Menampilkan Tombol Edit dan Hapus yg hanya bisa admin
            if (session('level') == "agendaris" or session('level') == "kadis" or session('level') == "administrator")
            {
                $btnedit = '<a href="'. base_url('/suratin/edit/').'/'.$d['id'] .'" class="dropdown-item">Edit</a>';
                $btnhapus = '<form method="POST" action="'. base_url('/Surat_In/hapus').'/'.$d['id'] .'">
                                <input type="submit" class="dropdown-item" value="Hapus" onclick="return hapus()"></button>
                            </form>';
            }
            
            //Tombol Disposisi
            if (session('level') != "kasubag" and session('level') != "kasi")
            {
                $daftardispo = [];

                if(session('akses') == "administrator" or session('akses') == "agendaris")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[0] .'" class="dropdown-item">'.$dispo[0] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[1] .'" class="dropdown-item">'.$dispo[1] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[2] .'" class="dropdown-item">'.$dispo[2] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[3] .'" class="dropdown-item">'.$dispo[3] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[4] .'" class="dropdown-item">'.$dispo[4] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[5] .'" class="dropdown-item">'.$dispo[5] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[6] .'" class="dropdown-item">'.$dispo[6] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[7] .'" class="dropdown-item">'.$dispo[7] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[8] .'" class="dropdown-item">'.$dispo[8] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[9] .'" class="dropdown-item">'.$dispo[9] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[10] .'" class="dropdown-item">'.$dispo[10] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[11] .'" class="dropdown-item">'.$dispo[11] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[12] .'" class="dropdown-item">'.$dispo[12] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[13] .'" class="dropdown-item">'.$dispo[13] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[14] .'" class="dropdown-item">'.$dispo[14] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[15] .'" class="dropdown-item">'.$dispo[15] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[16] .'" class="dropdown-item">'.$dispo[16] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[17] .'" class="dropdown-item">'.$dispo[17] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[18] .'" class="dropdown-item">'.$dispo[18] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[19] .'" class="dropdown-item">'.$dispo[19] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[20] .'" class="dropdown-item">'.$dispo[20] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[21] .'" class="dropdown-item">'.$dispo[21] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[22] .'" class="dropdown-item">'.$dispo[22] .'</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[23] .'" class="dropdown-item">'.$dispo[23] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[24] .'" class="dropdown-item">'.$dispo[24] .'</a>
                                    ';
                }
                else if(session('akses') == "KADIS")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[0] .'" class="dropdown-item">'.$dispo[0] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[3] .'" class="dropdown-item">'.$dispo[3] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[7] .'" class="dropdown-item">'.$dispo[7] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[11] .'" class="dropdown-item">'.$dispo[11] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[15] .'" class="dropdown-item">'.$dispo[15] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[19] .'" class="dropdown-item">'.$dispo[19] .'</a>';
                }
                else if(session('akses') == "sekdin")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[4] .'" class="dropdown-item">'.$dispo[4] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[5] .'" class="dropdown-item">'.$dispo[5] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[6] .'" class="dropdown-item">'.$dispo[6] .'</a>';
                }
                else if(session('akses') == "kabidp2")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[8] .'" class="dropdown-item">'.$dispo[8] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[9] .'" class="dropdown-item">'.$dispo[9] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[10] .'" class="dropdown-item">'.$dispo[10] .'</a>';
                }
                else if(session('akses') == "kabidsdk")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[12] .'" class="dropdown-item">'.$dispo[12] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[13] .'" class="dropdown-item">'.$dispo[13] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[14] .'" class="dropdown-item">'.$dispo[14] .'</a>';
                }
                else if(session('akses') == "kabidkesmas")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[16] .'" class="dropdown-item">'.$dispo[16] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[17] .'" class="dropdown-item">'.$dispo[17] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[18] .'" class="dropdown-item">'.$dispo[18] .'</a>';
                }
                else if(session('akses') == "kabidyankes")
                {
                    $daftardispo = '<a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[20] .'" class="dropdown-item">'.$dispo[20] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[21] .'" class="dropdown-item">'.$dispo[21] .'</a>
                                    <a href="'.base_url('/suratin/disposisi/').'/'.$d['id'].'/'.$dispo[22] .'" class="dropdown-item">'.$dispo[22] .'</a>';
                }
                else{
                    $daftardispo = [];
                }

                if(strtolower($d['akses']) == strtolower(session('akses')) or session('level') == "agendaris")
                {
                    $btndispo = '<div class="btn-group" >
                                    <button type="button "class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Disposisi</button>
                                    <div class="dropdown-menu scrollable-menu" style="height: auto; max-height: 100px; overflow-x: hidden; overflow-y: auto">    
                                    '.$daftardispo.'
                                ';
                }
            }

            //Rekap Data Ke Dalam AJAX
            $no++;
            $row = array();
            $row['no'] = $no;
            $row['no_surat'] = $d['no_surat'].' <p><b>'.$d['akses'].'</b></p>';
            $row['perihal'] = $d['perihal'].' '.$gbr;
            $row['tgl_surat'] = $d['tgl_surat'];
            $row['asal'] = $d['asal'];
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

        //Jadi Ke AJAX
        echo json_encode($output);
    }

    //DETAIL
    public function detail($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        $datanya = [
            'data' => $query
        ];

        return view('in/detailin', $datanya);
    }

    //EDIT
    public function edit($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        $datanya = [
            'data' => $query
        ];

        return view('in/editin', $datanya);
    }
    public function simpanedit()
    {
        $id = $this->request->getVar('id');

        $data =
            [
                'no_surat' => $this->request->getVar('no_surat'),
                'tgl_surat' => $this->request->getVar('tgl_surat'),
                'perihal' => $this->request->getVar('perihal'),
                'asal' => $this->request->getVar('asal'),
                'ket_disposisi' => $this->request->getVar('ket_disposisi')
            ];
            
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();

        return redirect()->to('/suratin/'.session('tahun'));
    }

    //HAPUS
    public function hapus($id)
    {
        $query = $this->db->where(['id' => $id])->first();

        if($query['nama_gbr'] != null){
            $namagbr = $query['nama_gbr'];
            unlink('file/'.$namagbr);
        }

        //unlink('file/1640072263_15470ea5ffd16c822d95.pdf');

        $this->db->delete(['id' => $id]);

        return redirect()->to('/suratin/'.session('tahun'));
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

        $upload = $this->db->insert($data);

        if($upload){
            session()->setFlashdata(array('pesan' => "sukses"));
            return redirect()->to('/suratin/'.session('tahun'));
        }
        else{
            session()->setFlashdata(array('pesan' => "gagal"));
            return redirect()->to('/suratin/'.session('tahun'));
        }
    }

    //DISPOSISI
    public function dispo($id,$ds)
    {
        $this->db->set('akses', $ds);
        $this->db->where('id', $id);
        $this->db->update();

        return redirect()->to('/suratin/'.session('tahun'));
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
