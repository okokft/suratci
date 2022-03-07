<?= $this->include('assets/header') ?>

<!-- Pesan Upload -->
<?php if(session()->getflashdata('pesan') == "gagal") { ?>
    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
        <strong>Gagal - </strong> Input Surat Gagal. Silahkan Coba Kembali..
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<?php if(session()->getflashdata('pesan') == "sukses") { ?>
    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
        <strong>Sukses - </strong> Surat Berhasil di Upload..
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="container-fluid mt-4">
    <h1 class="text-center">Surat Keluar</h1>
</div>

<div class="table-responsive container-fluid  mt-2 py-3 rounded" >
    <div class="btn-group">
        <?php
            if (session('level') == "agendaris" or session('level') == "administrator") { ?> 
            <!-- <a href="<?= base_url('/Surat_Out/tambah') ?>" class="btn btn-md btn-danger mb-3"><i class="fas fa-plus"></i></a> -->
            <a href="#" class="btn btn-md btn-danger mb-3 mr-1 rounded" data-toggle="modal" data-target="#tambahsurat"><i class="fas fa-plus"></i></a>
        <?php } ?>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle mb-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                <?= $tahun ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php for ($x = $tahunawal; $x <= $tahunsekarang; $x++) { ?>
                    <a class="dropdown-item" href="<?= base_url('/suratout'),"/",$x ?>"><?= $x ?></a>
                <?php }?>
            </div>
        </div>
    </div>

    <table  class="table table-info table display rounded" id="table_id" style="overflow-x:auto;">
            <thead>
                <tr>
                    <th  style="width: 10%">No.</th>
                    <th style="width: 10%">No Surat</th>
                    <th>Perihal</th>
                    <th style="width: 10%">Tgl Surat</th>
                    <th style="width: 15%">Tujuan</th>
                    <th style="width: 5%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            
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
        <form action="<?= base_url('Surat_Out/tambah') ?>" method="post" enctype="multipart/form-data">     
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
                <label for="tujuan">Tujuan</label>
                <input type="text" class="form-control" name="tujuan" required="required">
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


<script>
$(document).ready(function() {
    $('#table_id').DataTable( {
        'ajax': {
            'url' :"<?= base_url('Surat_Out/ajax_out') ?>",
            'type' : "POST"
        },
        //'responsive': true,
        'scrollX': true,
        "language": {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        "iDisplayLength": 10,
        'columns': [
            { data: 'no', 'searchable': false },
            { data: 'no_surat' },
            { data: 'perihal' },
            { data: 'tgl_surat' },
            { data: 'tujuan' },
            { data: 'aksi', 'searchable': false }
        ],
        "columnDefs": [
		            { responsivePriority: 1, targets: 1 },
		            { responsivePriority: 2, targets: 2 },
                    { responsivePriority: 3, targets: 3 }
		],
		'deferRender': true
    } );
} );
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
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
</script>
