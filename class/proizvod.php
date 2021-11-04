<?php
require "boja.php"; //Dodaj i ovu klasu zbog konvertovanja

class Proizvod {
    public $id;   
    public $naziv;   
    public $boja; //Mora da se konvertuje
    public $cena;
    
    public function __construct($id=null, $naziv=null, $boja=null, $cena=null){
        $this->id = $id;
        $this->naziv = $naziv;
        $this->boja = $boja;
        $this->cena = $cena;
    }

    //Unesi novi proizvod u bazu podataka
    public static function __createProizvod(Proizvod $p, mysqli $c){ //CREATE
        $b = Boja::__getIdByName($p->boja, $c);
        $q = "INSERT INTO proizvod(naziv, boja, cena) VALUES('$p->naziv', $b, '$p->cena')";
        return $c->query($q);
    }

    //Nadji sve proizvode i istampaj ih!
    public static function __getAllFromProizvod(mysqli $c){ //READ
        $q = "SELECT proizvod.id, naziv, ime, cena FROM proizvod INNER JOIN boje ON proizvod.boja = boje.id WHERE 1";
        return $c->query($q);
    }

    //Nadji poseban proizvod na osnovu ID-a
    public static function __getProizvodById($id, mysqli $c){ //READ
        $q = "SELECT proizvod.id, naziv, ime, cena FROM proizvod INNER JOIN boje ON proizvod.boja = boje.id WHERE proizvod.id=$id";
        return $c->query($q);
    }

    //Nadji proizvod/proizovde na osnovu imena
    public static function __getProizvodByName($name, mysqli $c){ //READ
        $q = "SELECT proizvod.id, naziv, ime, cena FROM proizvod INNER JOIN boje ON proizvod.boja = boje.id WHERE naziv='$name'";
        return $c->query($q);
    }

    //Pronadji trenutni proizvod i izmeni podatke
    public static function __updateProizvod(Proizvod $p, mysqli $c){ //UPDATE
        $b = Boja::__getIdByName($p->boja, $c);
        $q = "UPDATE `proizvod` SET `naziv`='$p->naziv',`boja`=$b,`cena`=$p->cena WHERE id=$p->id";
        return $c->query($q);
    }

    //Obrisi proizvod na osnovu ID-a
    public static function __deleteProizvod($id, mysqli $c){ //DELETE
        $q = "DELETE FROM proizvod WHERE id=$id";
        return $c->query($q);
    }
}

?>