<?php
require "../../include/connection.php"; //Povezivanje za bazom
require "../proizvod.php";

if (isset($_POST['id']) && isset($_POST['naziv']) && isset($_POST['cena']) && isset($_POST['idBoje'])){
    $pp = new Proizvod($_POST['id'], $_POST['naziv'], $_POST['idBoje'], $_POST['cena']);
    $_t = Proizvod::__updateProizvodById($pp, $_connection);
    if ($_t){
        echo 'Uspesno!';
    }
}

?> 