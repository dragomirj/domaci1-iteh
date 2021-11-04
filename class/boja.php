<?php
class Boja {
    public $id;
    public $ime;

    public function __construct($id=null, $ime=null){
        $this->id = $id;
        $this->ime = $ime;
    }

    //Funkcija koja vraca ID na osnovu unetog naziva
    public static function __getIdByName($name, mysqli $c){
        $q = "SELECT id FROM boje WHERE ime='$name'";
        return $c->query($q)->fetch_assoc()['id'];
    }

    //Unesi novu boju u bazu podataka
    public static function __createBoja(Boja $b, mysqli $c){ //CREATE
        $q = "INSERT INTO boje(ime) VALUES('$b->ime')";
        return $c->query($q);
    }
    
    //Nadji sve boje i istampaj ih!
    public static function __getAllFromBoja(mysqli $c){ //READ
        $q = "SELECT * FROM boje WHERE 1";
        return $c->query($q);
    }

    //Nadji posebnu boju na osnovu ID-a
    public static function __getBojaById($id, mysqli $c){ //READ
        $q = "SELECT * FROM boje WHERE id=$id";
        return $c->query($q);
    }

    //Nadji boju na osnovu imena
    public static function __getBojaByName($name, mysqli $c){ //READ
        $q = "SELECT * FROM boje WHERE ime='$name'";
        return $c->query($q);
    }

    //Pronadji trenutnu boju i izmeni podatke
    public static function __updateBoja(Boja $b, mysqli $c){ //UPDATE
        $q = "UPDATE `boje` SET `ime`='$b->ime' WHERE id=$b->id";
        return $c->query($q);
    }

    //Obrisi proizvod na osnovu ID-a
    public static function __deleteBoja($id, mysqli $c){ //DELETE
        $q = "DELETE FROM boje WHERE id=$id";
        return $c->query($q);
    }
}

?>