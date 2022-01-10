<?= $this->include('assets/header') ?>

<div class="container-fluid mt-4">
    <h1 class="text-center">Surat Masuk</h1>
</div>

<div class="table-responsive container-fluid  mt-2 py-3 rounded" >
    <?php
        if (session('level') == "agendaris" or session('level') == "administrator") { ?> 
        <!-- <a href="<?= base_url('/surat_in/tambah') ?>" class="btn btn-md btn-danger mb-3"><i class="fas fa-plus"></i></a> -->
        <a href="#" class="btn btn-md btn-danger mb-3" data-toggle="modal" data-target="#tambahsurat"><i class="fas fa-plus"></i></a>
    <?php } ?>
    <table  class="table table-info table display rounded" id="table_id" style="overflow-x:auto;">
        <thead>
            <tr>
                <th  style="width: 10%">No.</th>
                <th style="width: 10%">No Surat</th>
                <th>Perihal</th>
                <th style="width: 10%">Tgl Surat</th>
                <th style="width: 15%">Asal</th>
                <th style="width: 5%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($datadbin as $d) :?>
            <tr>
                <td scope="row"><?= $i++ ?></td>
                <td><?= $d['no_surat'] ?>
                    <b><?= $d['akses'];?></b></td>
                <td><?= $d['perihal'] ?>
                <?php if($d['nama_gbr'] != null){ ?>
                    <i class="far fa-file"></i></td>
                <?php } ?>
                <td><?= $d['tgl_surat'] ?></td>
                <td><?= $d['asal'] ?></td>
                <td>
                    <div class="btn-group">
                        <div class="btn-group">                          
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a href="<?= base_url('/suratin/detail/'),'/',$d['id'] ?>" class="dropdown-item">Detail</a>
                                <?php if (session('level') == "agendaris" or session('level') == "kadis" or session('level') == "administrator"){ ?>
                                    <a href="<?= base_url('/suratin/edit/'),'/',$d['id'] ?>" class="dropdown-item">Edit</a>
                                    <form method="POST" action="<?= base_url('/surat_in/hapus'),'/',$d['id'] ?>">
                                        <input type="submit" class="dropdown-item" value="Hapus" onclick="return hapus()"></button>
                                    </form>
                                <?php } ?>
                                <?php if($d['nama_gbr'] != null) {?>
                                    <a href="<?= base_url('/suratin/lihatgbr/'),'/',$d['id'] ?>" class="dropdown-item">Lihat Gambar</a>
                                <?php } ?>
                            </div>        
                        </div>
                        <?php if (session('level') != "kasubag" and session('level') != "kasi") { ?>
                            <div class="btn-group" >
                                <button type="button "class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Disposisi</button>
                                <div class="dropdown-menu scrollable-menu">
                                    <?php foreach($dispo as $ds) : ?>
                                        <a href="<?= base_url('/suratin/disposisi/'),'/',$d['id'],'/',$ds ?>" class="dropdown-item"><?= $ds ?></a>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>   
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Surat-->
<div class="modal fade" id="tambahsurat" tabindex="-1" role="dialog" aria-labelledby="exampleModal3" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('surat_in/tambah') ?>" method="post" enctype="multipart/form-data">     
            <div class="form-group">
                <label for="no_surat">No. Surat</label>
                <input type="text" class="form-control" name="no_surat" required="required">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="tgl_masuk" required="required" value="<?php echo date('Y-m-d'); ?>">
                <label for="tgl_surat">Tgl. Surat</label>
                <input type="date" class="form-control datepicker bootstrap-datepicker" name="tgl_surat" required="required">
            </div>
                <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" class="form-control" name="perihal" required="required">
            </div>
            <div class="form-group">
                <label for="asal">Asal</label>
                <input type="text" class="form-control" name="asal" required="required">
                <input type="hidden" class="form-control" name="akses" required="required" value="agendaris">
            </div>
            <div>
                <label>Upload Scan Gambar</label>
            </div>
                <div class="form-group custom-file mb-3">
                <label class="custom-file-label" for="gbr">Pilih Gambar atau PDF (Maks 2 MB)</label>
                <input type="file" accept=".jpg, .png, .pdf" class="custom-file-input" name="gbr">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Simpan</button>
            </div>       
        </form>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.js"></script>

<script type="text/javascript">
    function hapus()
    {
        let text = "Apakah Anda Yakin Untuk Menghapus?"
        if(confirm(text)==true){
            return true;
        }
        else{
            return false;
        }
    };

    $(document).ready(function() {
    var table = $('#table_id').DataTable( {
        responsive: true,
        "language": {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        "iDisplayLength": 10,
        "columns":[
            { 'searchable': false },
            null,
            null,
            null,
            null,
            { 'searchable': false },
        ]
    } );
      
});
$(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<?= $this->include('assets/footer') ?>