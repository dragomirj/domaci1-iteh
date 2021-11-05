<?php
session_start();
require_once "../include/connection.php"; //Povezivanje za bazom
require "../class/proizvod.php";
require "../include/other.php";

//Ako korisnik nije ulogovan prebaci ga na login
if (!isset($_SESSION['uname'])){
    header('Location: ../login.php');
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  

    <title>Dragomir J - Admin stranica</title>

    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/dj/favicon.png" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <style>
        label.error {
            color: red;
        }

        input.error {
            border: 1px solid red;
        }
        
        .footer-08 .aside-stretch-right {
            background: #12cc94;
        }

        .aside-stretch-right {
            background: #12cc94;
        }

        .footer-08 {
            padding: 0;
            overflow: hidden;
            background: #f1f6f5;
        }

        @media(min-width: 768px) {
            .wrapper{position:relative;}
            .bottom{position:absolute; bottom:0; width: 91%}
        }
    </style>

    <div class="container-fluid px-lg-5" style="background-color: blue">
        <div class="row">
            <div class="col-md-5 py-5">
                <div class="row">
                    <div class="col-md-4 mb-md-0 mb-4">
                        <h2 class="footer-heading">O nama</h2>
                        <p>Administratorska stranica preko koje se pretrazuju proizvodi preko PHP-a i dodaju novi proizvodi</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-9">
                                <div class="row">
                                    <div class="col-md-4 mb-md-0 mb-4" style="width:100% !important">
                                        <h2 class="footer-heading">Korisni linkovi</h2>
                                        <ul class="">
                                            <li><a href="../" class="py-1 d-block">Pocetna stranica</a></li>
                                            <li><a href="../?logout=1" class="py-1 d-block">Odjavi se</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5 wrapper" style="background-color: #339966 !important">
                <h2 class="footer-heading footer-heading-white">Pretraga</h2>
                <div class="form-group">
                    <input id="djSearchData" type="text" class="form-control" placeholder="Pretraga">
                </div>

                <div class="form-group bottom">
                    <button id="djSearchButton" type="submit" class="form-control submit px-3">Pronadji!</button>
                </div>
            </div>

            <!-- Kreiraj novi proizvod -->
            <div class="col-md-3 py-md-5 py-4 aside-stretch-right pl-lg-5 wrapper" style="background-color: #33cc33 !important">
                <h2 class="footer-heading footer-heading-white">Kreiraj novi</h2>
                <form id="djCreateForm">
                    <div class="form-group">
                        <input id="djFormNaziv" name="djFormNaziv" type="text" class="form-control" placeholder="Naziv proizvoda">
                    </div>
                    <div class="form-group">
                        <input id="djFormBoje" name="djFormBoje" type="text" class="form-control" placeholder="Boja proizvoda">
                    </div>
                    <div class="form-group">
                        <input id="djFormCena" name="djFormCena" type="text" class="form-control" placeholder="Cena proizvoda">
                    </div>
                    <div class="form-group bottom">
                        <button id="djCreateButton" type="submit" class="form-control submit px-3">Kreiraj!</button>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="row" style="margin-top: 30px; padding-bottom: 11px;">
            <table class="table" style="background-color: white">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Naziv</th>
                        <th scope="col">Boja</th>
                        <th scope="col">Cena</th>
                    </tr>
                </thead>

                <?php //DRAGOMIR J
                $r = Proizvod::__getAllFromProizvod('id', 'ASC', $_connection);

                $_num = $r->num_rows;
                $_data = array();
                $_pos  = 0;
                $_grid = 4;

                if ($_num > 0){ //Ako nije prezna tabela radi nesto!
                    $_i = 1;
                    while($row = $r->fetch_assoc()) {
                        echo '<tbody>
                    <tr>
                        <th scope="row">'. $_i++ .'</th>
                        <td>'. strtoupper($row['naziv']) .'</td>
                        <td>'. strtoupper($row['ime']) .'</td>
                        <td>'. $row['cena'] .'</td>
                    </tr>
                </tbody>';       
                    }
                }
                ?>

            </table>
        </div>
    </div>


    <!-- JS -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <!-- Proveri formu -->
    <script>
        $("#djCreateForm").validate({
            rules: {
                djFormNaziv: {
                    required: true
                }, djFormBoje: {
                    required: true
                }, djFormCena: {
                    required: true
                }
            }, messages: {
                djFormNaziv: "Unesite naziv proizvoda!",
                djFormBoje: "Unesite boju proizvoda!",
                djFromCena: "Unesite cenu proizvoda!"
            }
        });
    </script>
</body>
</html>