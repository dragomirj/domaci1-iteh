<?php
session_start();
require "include/connection.php"; //Povezivanje za bazom
require "class/korisnik.php";

$error = false;
if(isset($_POST['username']) && isset($_POST['password'])){
    $k = new Korisnik(null, $_POST['username'], $_POST['password']);
    $r = Korisnik::__checkLogin($k, $_connection);

    //print_r($r);
    if($r->num_rows == 1){ //Treba da postoji samo jedan korisnik sa ovim parametrima!
        $_SESSION['uname'] = $k->username;
        header('Location: index.php');
        exit(0);
    } else {
        $error = true;
    }
} 

//Korisnik je vec ulogovan
if (isset($_SESSION['uname'])){
    header('Location: index.php');
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  

    <title>Dragomir J - Login stranica</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/dj/favicon.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <style>
        label.error {
            color: red;
        }

        input.error {
            border: 1px solid red;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-4 p-4">
                    <form action="" method="POST" class="row g-3" id="djForm">
                        <h4>Forma za logovanje administratora!</h4>
                        <div class="col-12">
                            <label>Korisnicko ime:</label>
                            <input type="text" name="username" class="form-control" placeholder="Korisniko ime" style="<?php if($error){echo 'border:1px solid red';}?>">
                        </div>
                        <div class="col-12">
                            <label>Sifra:</label>
                            <input type="password" name="password" class="form-control" placeholder="Sirfa" style="<?php if($error){echo 'border:1px solid red';}?>">
                        </div>
                        <?php
                        if ($error == true){
                            echo '<div class="col-12" style="text-align:center">
                            <label style="color:red;"><b>Korisnicko ime ili sifra je pogresna!</b></label>
                        </div>';
                        }
                        ?>
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark float-end">Ulogujte se</button>
                        </div>
                    </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Dragomir J. [<a href="index.php">Nazad na pocetnu stranu</a>]</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>

    <!-- Proveri formu -->
    <script>
        $("#djForm").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5
                }, password: "required"
            }, messages: {
                username: "Unesite korisniko ime (minimum 5 karaktera)!",
                password: "Unesite sifru!"
            }
        });
    </script>
</body>
</html>