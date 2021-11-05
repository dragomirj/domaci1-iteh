//Dragomir J
function __redirectToLogin() {
  window.location.href="login.php";  
}

function __redirectToEntrance() {
  window.location.href="entrance/";  
}

//jQuery funkcije
$(document).ready(function(){
  $(".btn-warning").click(function(){
      //Posalji ID da dobijes nazad JSON sa svim podacima
      const _data = $(this).closest('div').attr('id');
      request = $.ajax({
        url:  'class/_post/modal.php',
        type: 'post',
        data: {data: _data},
        dataType: 'json'
      });

      request.done(function (__resp) {
        if (__resp != null && __resp['id'] != null){
          $('#djModalId').val(__resp['id']);
          $('#djModalNaziv').val(__resp['naziv']);
          $('#djModalCena').val(__resp['cena']);
          $('#djModalBoje option:contains("' + __resp['ime'] + '")').prop("selected", true);
          $(".promo-img").css({"background-image":"url(assets/img/" + __resp['naziv'] + '-' + __resp['ime'] + '.jpg'});

          //Pozovi modal sa novim podacima
          $("#djModal").modal('show');
        } else { //Ako je doslo do greske istampaj to i nemoj da radis nista sa modalom
          const __text = "Doslo je do greske prilikom citanja podataka iz baze za modal!";
          console.error(__text);
          alert(__text);
        }
    });
  });

  //Edituj trenutni proizvod
  $("#djEditButton").click(function(){
    const i = $("#djModalId").val();
    const n = $("#djModalNaziv").val();
    const c = $("#djModalCena").val();
    const b = $('#djModalBoje').val();
    
    request = $.ajax({
        url: 'class/_post/update.php',
        type:'post',
        data: {id: i, naziv: n, cena: c, idBoje: b},
    });

    request.done(function (__resp) {
      if (__resp == 'Uspesno!' ^ __resp == 'Uspesno! '){
        location.reload(true);
      } else {
        alert('Doslo je do greske prilikom editovanja proizvoda!');
      }
    });

    request.fail(function(jqXHR, __status) {
      alert('Request je bio neuspesan: ' + __status);
    });
  });

  //Napravi novi proizvod
  $("#djCreateButton").click(function(){
    const n = $("#djFormNaziv").val();
    const c = $("#djFormCena").val();
    const b = $('#djFormBoje').val();

    if (n != '' && c != '' && b != ''){
      request = $.ajax({
        url: '../class/_post/create.php',
        type:'post',
        data: {naziv: n, cena: c, boja: b},
      });

      request.done(function (__resp) {
        if (__resp == 'Uspesno!' ^ __resp == 'Uspesno! '){
          location.reload(true);
        } else {
          alert('Doslo je do greske prilikom dodavanja proizvoda!');
        }
      });

      request.fail(function(jqXHR, __status) {
        alert('Request je bio neuspesan: ' + __status);
      });
    } else {
      $("#djCreateForm").validate({
        debug: true,
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
    }
  });

  //Search na pocetnoj strani
  $('#djSearch').keypress(function(event){
    let keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){ //Ako je pritisnut enter
      if (this.value != ''){
        $('div.shadow-sm').css({"border":"none"});
        $(":contains(" + this.value.toUpperCase() + ")").closest('div.shadow-sm').css({"border":"3px solid red"});
      } else {
        $('div.shadow-sm').css({"border":"none"}); //Restartuj svaki border
      }
    }
  });

  //Pretraga u entrance
  $("#djSearchButton").click(function(){
    if ($('#djSearchData').val() != ''){
      $('tr').css({'background-color':"white"});
      $(":contains(" + $('#djSearchData').val().toUpperCase() + ")").closest('tr').css({"background-color":"greenyellow"});
    } else {
      $('tr').css({'background-color':"white"});
    }
  });

  //Kada se promeni sortData
  $('#djSortData').on('change', function() {
    window.location.replace('?sortData=' + this.value + '&sortType=' + $('#djSortType').val());
  });

  //Kada se promeni sortType
  $('#djSortType').on('change', function() {
    window.location.replace('?sortData=' + $('#djSortData').val() + '&sortType=' + this.value);
  });

  $("#djLogout").click(function() {
    window.location.replace("?logout=1");
  });
});