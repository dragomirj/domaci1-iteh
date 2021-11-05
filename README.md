### OPIS
Sajt je napravljen kao jedna jednostavna prodavnica garderobe. Kada se udje na sajt prikazani su svi proizvodi koji mogu da se sortiraju pomocu PHP-a putem
dva select dugmeta u footeru. Takodje sajt ima i search preko jQuery-ja gde promeni sve pozadine proizvoda koji ispunjavaju uslov. Na vrhu sajta postoji
jedno dugme koje nas vodi na login.php i koji sluzi iskljucivo sa ulogovanje administratora na sajt. Kada se uloguje prikazuju se `EDIT` dugmici preko kojih
moze da se izmeni bilo koji proizvod preko modal-a. Posto smo ulogovani postoji sada dugme da se izlogujemo i dugme za stranicu gde mozemo da dodajemo nove proizvode.
Kada kliknemo na `Panel` dugme onda idemo na /entrance gde mozemo da pretrazujemo proizvode kao i da dodajemo nove.

### PRIKAZ SVIH DATOTEKA KAO I KRATKO OBJASNJENJE
index.php                   > Glavna stranica
login.php                   > Stranica za logovanje posle koje se redirektuje na index.php

/tests                      > 2fajla gde su testiranje sve funkcije klasa
/include/connection.php     > konekcija sa bazom
/include/other.php          > Ovde se nalazi funkcija za kreiranje modala
/entrance                   > Administratorska stranica za dodavanje novih proizvoda

/class/_post/create.php     > Fajl u kome se POST-uju podaci preko AJAX-a
/class/_post/modal.php      > Preko POST-a dobija `ID` proizvoda i zatim vraca sve njegove podatke u JSON formatu
/class/_post/update.php     > Isto preko AJAX-a i POST-a dobija podatke samo ovde menja postojeci proizvod
/class/boja.php             > Klasa Boje a svim dodatim funkcijama za OOP
/class/korisnik.php         > Klasa za korisnika
/class/proizvod.php         > Klasa Proizvoda sa svim dodatim funkcijama za OOP

/assets/css/main.css        > glavni css fajl
/assets/css/modal.css       > css fajl za modal

/assets/js/main.js          > glavna js komponenta