<?= $this->include('assets/header') ?>

<!-- Header -->
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-2">
      <center>
        <img class="hilang" src="<?= base_url('/img/icon.png') ?>" style="width:70%;min-height=20%">
      </center>
    </div><div class="col-8">
      <center>
        &nbsp;
        <h1><b>Dinas Kesehatan Kabupaten Bondowoso</b></h1>
        <h3>Aplikasi Arsip Surat Internal</h3>
      </center>
    </div>
    <div class="col-2">
      <center>
        <img class="hilang" src="<?= base_url('/img/kemenkes.png') ?>" style="width:70%;min-height=10%">
      </center>
    </div>
  </div>
</div>

<!-- ISINYA -->
<div class="container mt-3">
  <div class="row">
    <div class="col-sm-4">
      <div class="col-sm-12 bg-secondary my-4 pt-4 rounded">
        <center>
          <img class="" src="<?= base_url('/img/inbox.png') ?>" style="width:50%;min-height=20%">
        </center>
        <div class="card-body text-center">
        <h2><?= $hslIn ?><a href="<?= base_url("/suratin"),"/",date('Y') ?>" class="btn btn-sm stretched-link"></a>Surat Masuk</h2>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-1">
      <!-- Jarak Antar col -->
    </div>
    <div class="col-sm-4">
      <div class="col-sm-12 bg-info my-4 pt-4 rounded">
        <center>
          <img class="" src="<?= base_url('/img/outbox.png') ?>" style="width:50%;min-height=20%">
        </center>
        <div class="card-body text-center">
        <h2><?= $hslOut ?><a href="<?= base_url("/suratout"),"/",date('Y') ?>" class="btn btn-sm stretched-link"></a>Surat Keluar</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


<?= $this->include('assets/footer') ?>