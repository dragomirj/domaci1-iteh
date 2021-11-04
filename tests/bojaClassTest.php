<?php //Dragomir J - TEST ALL FUNCTIONS FROM BOJA CLASS
require "../include/connection.php"; //Povezivanje za bazom
require "../class/boja.php";

//TEST01 __getIdByName
echo 'TEST01><br>';
$name = "ljubicasta";
$_data = Boja::__getIdByName($name, $_connection);
echo 'Boja: <font style="background-color: black; color: white;">'. $name .'</font> ima ID: <i>'. $_data .'</i><br>';

//TEST02 __getAllFromBoja()
echo '<br>TEST02><br>';
$_test = Boja::__getAllFromBoja($_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', IME: '. $row['ime'] .'<br>';
}

//TEST03 __getBojaById()
echo '<br>TEST03><br>';
$id = 5;
$_test = Boja::__getBojaById($id, $_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', IME: '. $row['ime'] .' <font style="background-color: purple; color: white;">>>> OVDE TREBA DA BUDE SAMO JEDNA BOJA!</font><br>';
}

//TEST04 __getBojaByName()
echo '<br>TEST04><br>';
$_test = Boja::__getBojaByName($name, $_connection);
while($row = $_test->fetch_assoc()) {
    echo 'ID: '. $row['id'] .', IME: '. $row['ime'] .'<br>';
}

//TEST05 __createBoja
echo '<br>TEST05><br>';
$boja = new Boja(null, "TEST05-ClassTest-Create");
$_test = Boja::__createBoja($boja, $_connection);
if ($_test){
    echo 'USPESNO JE UNETA BOJA!<br>';
}

//TEST06 __updateBoja
echo '<br>TEST06><br>';
$boja = new Boja($_connection->insert_id, "TEST06-ClassTest-Update");
$_test = Boja::__updateBoja($boja, $_connection);
if ($_test){
    echo 'USPESNO JE IZMENJENA BOJA!<br>';
}

//TEST07 __deleteBoja
echo '<br>TEST07><br>';
$_test = Boja::__deleteBoja($boja->id, $_connection);
if ($_test){
    echo 'USPESNO JE OBRISAN Boja!<br>';
}
