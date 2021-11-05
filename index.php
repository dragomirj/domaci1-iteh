<?php
session_start();
require "include/connection.php"; //Povezivanje za bazom
require "class/proizvod.php";
require "include/other.php";

//Logout
if (isset($_SESSION['uname'])){
    if (!empty($_GET['logout'])){
        unset($_SESSION['uname']);
        header('Location: index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  

    <title>Dragomir J - Pocetna stranica</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/dj/favicon.png" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
        
            <!-- Navbar LOGO -->
            <a class="navbar-brand me-2" href="#">
                <img src="assets/img/dj/logo.png" alt="Dragomir J" style="margin-top: -3px;"/>
            </a>

            <!-- Nestajaci panel kada je preko telefona -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="entrance/">Administratorski panel</a> -->
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center">
                <?php 
                if(isset($_SESSION['uname'])){
                    echo '<button id="djLogout" type="button" class="btn btn-link px-3 me-2">Odjavi me!</button>';
                    echo '<button id="djEntrance" type="button" class="btn btn-primary me-3" onclick="__redirectToEntrance()">Panel</button>';
                } else {
                    echo '<button id="djLogin" type="button" class="btn btn-primary me-3" onclick="__redirectToLogin()">Prijava</button>';
                }
                ?>
                
            </div>
        </nav>

        <main>
            <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                <?php //DRAGOMIR J
                $r = null; //Vrati sve proizvode iz baze podataka
                if (isset($_GET['sortData']) && isset($_GET['sortType'])){
                    //Ako postoje uslovi za sortiranje 
                    $r = Proizvod::__getAllFromProizvod($_GET['sortData'], $_GET['sortType'], $_connection);
                } else {
                    //Sortiraj po idu u rastucem redosledu ako nema uslova
                    $r = Proizvod::__getAllFromProizvod('id', 'ASC', $_connection);
                }
                
                $_num = $r->num_rows;
                $_data = array();
                $_pos  = 0;
                $_grid = 4;

                if ($_num > 0){ //Ako nije prezna tabela radi nesto!
                    while($row = $r->fetch_assoc()) {
                        //Ubaci sve podatke u VAR da bi mogli preko for-a ispod da uzimamo lakse podatke!
                        array_push($_data, $row);
                    }

                    for ($i = 0; $i < ceil($_num/$_grid); $i++) { //Redovi
                        echo '<div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">';
                        for ($j = $_pos; $j < $_pos + $_grid; $j++) { //Kolone
                            if ($j < $_num){
                                $n = $_data[$j]['naziv'];
                                $b = $_data[$j]['ime'];
                                $c = $_data[$j]['cena'];
                                
                                //Stavljeno ovako da bi u VIEW SOURCE-u izgledalo kao da je rukom napisano!
                                $_path = "assets/img/" . $n . "-" . $b . ".jpg";
                                echo '
                    <div class="col">
                        <div class="card h-100 shadow-sm"><img src="'. $_path .'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="clearfix mb-3"><span class="float-start badge rounded-pill bg-primary">'. strtoupper($n) .'</span> <span class="float-end price-hp">'. $c .' RSD</span></div>
                                <h7 class="card-title">Boja artikla je: '. strtoupper($b) .'<br> Velicine: <b>S/M/L/XL</b></h7>';

                                //OVO ISKLJUCIVO ZA ADMINISTRATORE KOJI SU ULOGOVANI
                                if (isset($_SESSION['uname'])){
                                    echo '
                                <div id="'. $_data[$j]['id'] .'"class="text-center my-4 djModalClass"> <a href="#" id="djModalButton" class="btn btn-warning">Edit</a></div>';
                                }

                                echo '
                            </div>
                        </div>
                    </div>';
                            }
                        }
        
                        echo '
                </div>';
                        $_pos = ($i+1)*$_grid; //Pocetna pozicija nakon svake iteracije reda
                    }
                }
                ?>

            </div>
        </main>
    
        <!-- FOOTER -->
        <div class="bg-custom mt-5 pt-30 pt-60 pb-5">
            <h2 class="text-center text-white">Footer</h2>
            <div class="row">
                <div class="col-md-12 p-5">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>Opis</h3>
                            <p class="pt-4">Domaci1-ITEH</p>
                        </div>

                        <div class="col-md-3">
                            <h3>Linkovi</h3>
                            <ul>
                                <?php
                                if (isset($_SESSION['uname'])){
                                    echo '<li><a href="entrance">Admin panel</a></a></li>
                                <li><a href="?logout=1">Odjavi me!</a></li>';
                                } else {
                                    echo '<li><a href="login.php">Ulogujte se!</a></a></li>';
                                }
                                ?>

                            </ul>
                        </div>
                        <div class="col-md-3 mobile-none">
                            <div class="input-group mb-3">
                                <input id="djSearch" type="text" class="form-control" placeholder="Search">
                            </div>

                            <div class="input-group mb-3">
                                <select name="djSortData" id="djSortData">
                                    <?php
                                    if (isset($_GET['sortData'])){
                                        $_array = array("id", "naziv", "boja", "cena");
                                        foreach ($_array as $v) {
                                            if ($v != $_GET['sortData']){
                                                echo '<option value="'. $v .'">Sortiraj preko: '. ucfirst($v) .'</option>';
                                            } else {
                                                echo '<option value="'. $v .'" selected>Sortiraj preko: '. ucfirst($v) .'</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option value="id">Sortiraj preko: Id</option>
                                    <option value="naziv">Sortiraj preko: Naziv</option>
                                    <option value="boja">Sortiraj preko: Boja</option>
                                    <option value="cena">Sortiraj preko: Cena</option>';
                                    }
                                    ?>

                                </select>
                                <select name="djSortType" id="djSortType">
                                    <?php
                                    if (isset($_GET['sortType']) && $_GET['sortType'] == 'DESC'){
                                        echo '<option value="ASC">ASC</option>
                                    <option value="DESC" selected>DESC</option>';
                                    } else {
                                        echo '<option value="ASC" selected>ASC</option>
                                    <option value="DESC">DESC</option>';
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- CONTAINER -->
    
    <!-- MODAL -->
    <?php
        //Ova funkcija kreira modal na osnovu dobijenih podataka
        __createModal(Boja::__getAllFromBoja($_connection));
    ?>

    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

