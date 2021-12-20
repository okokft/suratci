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
    <link rel="stylesheet" type="text/css" href="<?= base_url('/css/datatables.min.css') ?>"/>
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= base_url('/js/datatables.min.js') ?>"></script>

    <script>
    $(document).ready(function() {
        var table = $('#table_id').DataTable( {
            responsive: true,
            "language": {
            url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            },
            "iDisplayLength": 10,
        } );
        
    });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->