<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script language='JavaScript'>
        var txt="E-Surat Dinkes Bondowoso ~ ";
        var speed=300;
        var refresh=null;
        function action() { document.title=txt;
        txt=txt.substring(1,txt.length)+txt.charAt(0);
        refresh=setTimeout("action()",speed);}action();
    </script>

    <link rel="icon" href="<?= base_url('/img/icon.png') ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
    @media screen and (max-width: 480px) {
    .hilang {
        display: none;
        }
    .kecil {
        padding: 10px;
        }
    .mh {
        max-height: 50px;
        }
    }
    </style>

</head>

<body background="<?php echo base_url('/img/bgnya.png') ?>" style="background-attachment:fixed"> 

    <!-- Pesan Gagal -->
    <?php if(session()->getflashdata('pesan') == "gagal1") { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal - </strong> Username atau Password Salah. Silahkan Cek Kembali..
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>

    <!-- Pesan Gagal -->
    <?php if(session()->getflashdata('pesan') == "gagal2") { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal - </strong> Cookies Gagal
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>

  <!-- Header -->
    <div class="container-fluid mt-2">
    <div class="row">
        <div class="col-2">
        <center>
            <img class="hilang mt-2" src="<?= base_url('/img/icon.png') ?>" style="width:60%;min-height=20%">
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
            <img class="hilang mt-2" src="<?= base_url('/img/kemenkes.png') ?>" style="width:60%;min-height=10%">
        </center>
        </div>
    </div>
    </div>

    <br class="hilang">
    <br class="hilang">
    <br class="hilang">

  <!-- ISINYA -->
    <div class="container mt-3">
    <div class="row">
        <div class="col-sm-4 hilang">
            <div class="col-sm-12 bg-secondary my-4 pt-4 rounded">
                <center>
                <img class="" src="<?= base_url('/img/inbox.png') ?>" style="width:50%;min-height=20%">
                </center>
                <div class="card-body text-center">
                <h2><?= $hslIn ?></a> Surat Masuk</h2>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="col-sm-12  py-3 rounded">
                <div class="login-form pt-3">
                    <form action="<?= base_url('/login/ceklogin') ?>" method="post">
                        <h4 class="text-center mb-4">Silahkan Login Terlebih Dahulu</h4>       
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" required="required" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" required="required" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 hilang">
            <div class="col-sm-12 bg-info my-4 pt-4 rounded">
                <center>
                <img class="" src="<?= base_url('/img/outbox.png') ?>" style="width:50%;min-height=20%">
                </center>
                <div class="card-body text-center">
                <h2><?= $hslOut ?></a> Surat Keluar</h2>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
