<?php
require "../../include/connection.php"; //Povezivanje za bazom
require "../proizvod.php";

if (isset($_POST['naziv']) && isset($_POST['cena']) && isset($_POST['boja'])){
    $pp = new Proizvod(null, $_POST['naziv'], $_POST['boja'], $_POST['cena']);

    $_boja = Boja::__getBojaByName($_POST['boja'], $_connection);
    if ($_boja->num_rows == 0){
        //Boja ne postoji u bazi i zato je napravi prvo
        Boja::__createBoja(new Boja(null, $_POST['boja']), $_connection);
    }

    $_t = Proizvod::__createProizvodByName($pp, $_connection);
    if ($_t){
        echo 'Uspesno!';
    }
}

?> 