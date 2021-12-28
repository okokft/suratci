<!doctype html>
<html lang="en">
<head>
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

    <!-- Datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('/css/datatables.min.css') ?>"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.css"/>

    <!-- FontAwesome -->
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

    <title>Hello, world!</title>
</head>

<body background="<?php echo base_url('/img/bgnya.png') ?>" style="background-attachment:fixed"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>">E-Surat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/suratin') ?>">Surat Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/suratout') ?>">Surat Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
            </ul>
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Halo <b><?= session('nama') ?></b>, Anda telah login sebagai <b><?= session('level') ?></b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login/logout') ?>">Logout</a>
                    </li>
                </ul>
        </div>
    </nav>

    