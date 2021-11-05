<?php
require "boja.php"; //Dodaj i ovu klasu zbog konvertovanja

class Proizvod {
    public $id;   
    public $naziv;   
    public $boja;
    public $cena;
    
    public function __construct($id=null, $naziv=null, $boja=null, $cena=null){
        $this->id = $id;
        $this->naziv = $naziv;
        $this->boja = $boja;
        $this->cena = $cena;
    }

    //Unesi novi proizvod u bazu podataka (Boja ide preko imena)
    public static function __createProizvodByName(Proizvod $p, mysqli $c){ //CREATE
        $b = Boja::__getIdByName($p->boja, $c);
        $q = "INSERT INTO proizvod(naziv, boja, cena) VALUES('$p->naziv', $b, '$p->cena')";
        return $c->query($q);
    }

    //Unesi novi proizvod u bazu podataka (Boja ide preko Id-a)
    public static function __createProizvodById(Proizvod $p, mysqli $c){ //CREATE
        $q = "INSERT INTO proizvod(naziv, boja, cena) VALUES('$p->naziv', $p->boja, '$p->cena')";
        return $c->query($q);
    }

    //Nadji sve proizvode i istampaj ih!
    public static function __getAllFromProizvod($_data, $_type, mysqli $c){ //READ
        $q = "SELECT proizvod.id, naziv, ime, cena FROM proizvod INNER JOIN boje ON proizvod.boja = boje.id WHERE 1 ORDER BY $_data $_type";
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

    //Pronadji trenutni proizvod i izmeni podatke (Boja ide preko imena)
    public static function __updateProizvodByName(Proizvod $p, mysqli $c){ //UPDATE
        $b = Boja::__getIdByName($p->boja, $c);
        $q = "UPDATE `proizvod` SET `naziv`='$p->naziv',`boja`=$b,`cena`=$p->cena WHERE id=$p->id";
        return $c->query($q);
    }

    //Pronadji trenutni proizvod i izmeni podatke (Boja ide preko Id-a)
    public static function __updateProizvodById(Proizvod $p, mysqli $c){ //UPDATE
        $q = "UPDATE `proizvod` SET `naziv`='$p->naziv',`boja`=$p->boja,`cena`=$p->cena WHERE id=$p->id";
        return $c->query($q);
    }

    //Obrisi proizvod na osnovu ID-a
    public static function __deleteProizvod($id, mysqli $c){ //DELETE
        $q = "DELETE FROM proizvod WHERE id=$id";
        return $c->query($q);
    }
}

?>