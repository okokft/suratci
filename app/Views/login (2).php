<!DOCTYPE html>
<html lang="en">
<head>
    <script language='JavaScript'>
        var txt="E-Surat Dinkes Bondowoso ~ ";
        var speed=300;
        var refresh=null;
        function action() { document.title=txt;
        txt=txt.substring(1,txt.length)+txt.charAt(0);
        refresh=setTimeout("action()",speed);}action();
    </script>

    <link rel="icon" href="<?= base_url('/img/icon.png') ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
    .login-form {
        width: 340px;
        margin: 100px auto;
        font-size: 15px;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    .link {
    color:aqua;
    text-decoration: none; 
    background-color: none;
    }
    </style>
</head>

<body background="<?= base_url('/img/bgnya.png') ?>">

    <?php if(session()->getflashdata('pesan') == "gagal123") { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal - </strong> Username atau Password Salah. Silahkan Cek Kembali..
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>

    <div class="login-form">
        <form action="<?= base_url('/login/ceklogin') ?>" method="post">
            <h2 class="text-center">Masuk</h2>       
            <div class="form-group">
                <input type="text" class="form-control" name="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
        </form>
        <!-- <a href="index.php" class="link"><button class="btn btn-success btn-block">Kembali</button></a> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>