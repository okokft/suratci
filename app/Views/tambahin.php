<?= $this->include('header') ?>

<div class="container-fluid my-4">
    <h1 class="text-center">Tambah Surat</h1>
</div>

<div class="container">
    <div class="edit-form">
        <form action="<?= base_url('surat_in/simpansurat') ?>" method="post" enctype="multipart/form-data">     
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
            <!-- <div>
                <label>Upload Scan Gambar</label>
            </div>
                <div class="form-group custom-file">
                <label class="custom-file-label" for="gbr">Pilih Gambar atau PDF (Maks 2 MB)</label>
                <input type="file" accept=".jpg, .png, .pdf" class="custom-file-input" name="gbr">
            </div>
            <script>
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script> -->
            <br/>
            <br/>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Simpan</button>
            </div>       
        </form>
    </div>  
</div>