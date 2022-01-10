<?= $this->include('assets/header') ?>

<div class="container-fluid mt-4">
    <h1 class="text-center">Edit Surat</h1>
</div>

<div class="container">

	<div class="edit-form"><b>
        <form action="<?= base_url('Surat_Out/simpanedit') ?>" method="post" enctype="application/x-www-form-urlencoded">     
            <div class="form-group">
                <label for="no_surat">No. Surat</label>
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <input type="text" class="form-control" name="no_surat" required="required" value="<?php echo $data['no_surat']; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_surat">Tgl. Surat</label>
                <input type="date" class="form-control datepicker bootstrap-datepicker" name="tgl_surat" required="required" value="<?php echo $data['tgl_surat']; ?>">
            </div>
            <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" class="form-control" name="perihal" required="required" value="<?php echo $data['perihal']; ?>">
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan</label>
                <input type="text" class="form-control" name="tujuan" required="required" value="<?php echo $data['tujuan']; ?>">
            </div>
            <div class="form-group">
                <label for="ket_disposisi">Keterangan Disposisi</label>
                <textarea class="form-signing form-control" name="ket_disposisi" rows="10" ><?php echo $data['ket_disposisi']; ?></textarea>
            </div>
            <div>
            <br/>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Simpan</button>
            </div>       
        </form></b>
    </div>	
</div>

<?= $this->include('assets/footer') ?>