<?php

require "../../include/connection.php"; //Povezivanje za bazom
require "../proizvod.php";

if (isset($_POST['data'])){
    $r = Proizvod::__getProizvodById($_POST['data'], $_connection);
    if ($r->num_rows == 1){
        $_data = $r->fetch_assoc();
        echo json_encode($_data);
    }
}

?>