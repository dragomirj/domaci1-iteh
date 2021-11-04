<?php //Dragomir J - TEST ALL FUNCTIONS FROM PROIZVOD CLASS
require "../include/connection.php"; //Povezivanje za bazom
require "../class/proizvod.php";

//TEST01 __getAllFromProizvod()
echo 'TEST01><br>';
$_test = Proizvod::__getAllFromProizvod($_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', NAZIV: '. $row['naziv'] .', BOJA: '. $row['ime'] .', CENA: '. $row['cena'] .'<br>';
}

//TEST02 __getProizvodById()
echo '<br>TEST02><br>';
$id = 5;
$_test = Proizvod::__getProizvodById($id, $_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', NAZIV: '. $row['naziv'] .', BOJA: '. $row['ime'] .', CENA: '. $row['cena'] .'<br>';
}

//TEST03 __getProizvodByName()
echo '<br>TEST03><br>';
$name = "Majica-Tip1";
$_test = Proizvod::__getProizvodByName($name, $_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', NAZIV: '. $row['naziv'] .', BOJA: '. $row['ime'] .', CENA: '. $row['cena'] .'<br>';
}

//TEST04 __createProizvod
echo '<br>TEST04><br>';
$proizvod = new Proizvod(null, "TEST04-ClassTest-Create", 'zuta', '9999.99');
$_test = Proizvod::__createProizvod($proizvod, $_connection);
if ($_test){
    echo 'USPESNO JE UNET PROIZVOD!<br>';
}

//TEST05 __updateProizvod
echo '<br>TEST05><br>';
$proizvod = new Proizvod($_connection->insert_id, "TEST04-ClassTest-Update", 'zuta', '9999.99');
$_test = Proizvod::__updateProizvod($proizvod, $_connection);
if ($_test){
    echo 'USPESNO JE IZMENJEN PROIZVOD!<br>';
}

//TEST06 __deleteProizvod
echo '<br>TEST06><br>';
$_test = Proizvod::__deleteProizvod($proizvod->id, $_connection);
if ($_test){
    echo 'USPESNO JE OBRISAN PROIZVOD!<br>';
}