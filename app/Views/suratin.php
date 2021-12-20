<?= $this->include('header') ?>

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
                <td scope="row"><?= $i++; ?></td>
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
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#hapus">Hapus</a>
                                <?php } ?>
                                <?php if (session('level') != "kasubag" and session('level') != "kasi") { ?>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#disposisi">Disposisi</a>
                                <?php } ?>
                                <?php if($d['nama_gbr'] != null) {?>
                                    <a href="<?= base_url('/suratin/lihatgambar/'),'/',$d['id'] ?>" class="dropdown-item">Lihat Gambar</a>
                                <?php } ?>
                            </div>        
                        </div>
                    </div>   
                </td>
            </tr>

            <!-- Modal Hapus-->
            <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModal1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Haqqul Yaqin untuk menghapus?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary" href="<?= base_url('/surat_in/hapus'),'/',$d['id'] ?>">Ya</a>
                </div>
                </div>
            </div>
            </div>

            <!-- Modal Disposisi-->
            <div class="modal fade" id="disposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Disposisi Kepada :</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="<?= base_url('surat_in/disposisi') ?>" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="modal-body">
                        <select class="form-group form-select" name="dispo" id="dispo">
                            <?php foreach($dispo as $ds) : ?>
                                <option name="dispo" value="<?= $ds ?>"><?= $ds ?></option>
                            <?php endforeach ?>
                        </select>
                        <input type="hidden" class="form-control" name="id_surat" required="required" value="<?= $d['id'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Disposisi</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            </div>

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
        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Simpan</button>
        </div>       
    </form>
    </div>
    </div>
</div>
</div>

<?= $this->include('footer') ?>