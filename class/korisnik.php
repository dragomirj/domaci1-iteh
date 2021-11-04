<?php
class Korisnik {
    public $id;
    public $username;
    public $password;

    public function __construct($id=null, $username=null, $password=null){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    //Proveri da li postoji korisnik u bazi podataka
    public static function __checkLogin(Korisnik $k, mysqli $c){
        $q = "SELECT * FROM korisnik WHERE username='$k->username' AND password='$k->password'";
        return $c->query($q);
    }
}