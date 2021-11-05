<?php

//Kreiraj Modal na osnovu dobijenih podataka
function __createModal($r){
    echo '<div class="modal fade" id="djModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body py-0">
                    <div class="d-flex main-content">
                        <div class="bg-image promo-img mr-3" style=""></div>
                        <div class="content-text p-4">
                            <h3>Modal za editovanje proizvoda!</h3>
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="djModalId" placeholder="Id proizvoda" disabled>
                            </div>

                            <div class="form-group">
                                <label for="naziv">Naziv</label>
                                <input type="text" class="form-control" id="djModalNaziv" placeholder="Naziv proizvoda">
                            </div>

                            <!-- Selektor za boje -->
                            <div class="form-group">
                                <label for="boje">Boje</label>
                                <select id="djModalBoje" name="boje" class="custom-select">';

                                if ($r->num_rows > 0){ //Ako nije prezna tabela istampaj sve boje!
                                    while($row = $r->fetch_assoc()) {
                                        echo '
                                    <option value="'. $row['id'] .'">'. $row['ime'] .'</option>';
                                    }
                                }
                            
                                echo '
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cena">Cena proizvoda</label>
                                <input type="text" class="form-control" id="djModalCena" placeholder="Cena proizvoda">
                            </div>

                            <div class="form-group">
                                <input id="djEditButton" type="submit" value="Izmeni" class="btn btn-primary btn-block">
                            </div>
                            <div class="form-group ">
                                <p class="custom-note"><small>Dragomir J - Modal za editovanje trenutnog proizvoda</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

?>