<?php if($pathinfo == "pdf"){ ?>
    <center>
    <br>
    <div>
    <iframe src="<?=base_url('file/'.$namagbr)?>#toolbar=0"  width="1300" height="600"></iframe>
    </div>
    </center>
<?php }
else {?>		
    <center>
    <!-- <a href="php/download.php?gbr='.$data['nama_gbr'].'"><button>Unduh</button></a> -->
    <br>
    <img src="<?= base_url('file/'.$namagbr) ?>" width="700">
    </center>
<?php } ?>