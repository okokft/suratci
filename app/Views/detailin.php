<?= $this->include('header') ?>

<div class="container-fluid mt-4">
    <h1 class="text-center">Detail</h1>
</div>

<div class="container">
	<div class="edit-form">
    <form action="#" method="post">     
        <div class="form-group">
        	<label for="no_surat">No. Surat</label>
        	<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="text" class="form-control" name="no_surat" readonly required="required" value="<?php echo $data['no_surat']; ?>">
        </div>
        <div class="form-group">
        	<label for="tgl_surat">Tgl. Surat</label>
            <input type="date" class="form-control datepicker bootstrap-datepicker" name="tgl_surat" required="required" readonly value="<?php echo $data['tgl_surat']; ?>">
        </div>
        <div class="form-group">
        	<label for="perihal">Perihal</label>
            <input type="text" class="form-control" name="perihal" required="required" readonly value="<?php echo $data['perihal']; ?>">
        </div>
        <div class="form-group">
          <label for="asal">Asal</label>
            <input type="text" class="form-control" name="asal" required="required" readonly value="<?php echo $data['asal']; ?>">
        </div>
        <div class="form-group">
        	<label for="disposisi">Keterangan Disposisi</label>
            <textarea class="form-signing form-control" name="disposisi" readonly required="required" rows="5" ><?php echo $data['ket_disposisi']; ?></textarea>
        </div>   
    </form>
    <div>
        <a href="<?= base_url('/suratin')?>" class="btn btn-success btn-block">Kembali</a>
    </div>    
    <br/>

<?= $this->include('footer') ?>