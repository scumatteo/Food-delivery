$(document).ready(function() {

  var ordiniConfermati = [];
  var ordiniInConsegna = [];
  var ordiniConsegnati = [];

  $.ajax({
    url: "../controller/all_orders_for_messenger.php",
    type: "POST",
    data: {'stato' : 'confermato'},
    success: function(response){
      var json = JSON.parse(response);
      for(var i = 0; i < json.length; i++){
        ordiniConfermati[i] = json[i];
      }

      populateCardConfermati();
      $('.consegna').on('click', function() {
        index = $(this).parent().parent().index();
        $.ajax({
          url: "../controller/fattorino_modifica_stato.php",
          type: "POST",
          data:{'stato' : 'in consegna', 'idOrdine' : ordiniConfermati[index].idOrdine},
          success: function(response){
            location.reload();
          }

        });
      });
      $('.btn-secondary').on('click', function() {
        $(this).parent().parent().hide();
      });
    }
  });

function populateCardConfermati(){
  $('#todo').empty();
  if(ordiniConfermati.length == 0){
      $('#todo').append('<h4>Non hai ancora ordini in arrivo</h4>');
  }
  else{
    for(var i = 0; i < ordiniConfermati.length; i++){
      $('#todo').append('<div class="card"><div class="card-header">Id Ordine: '+ ordiniConfermati[i].idOrdine+'</div>'+
          '<div class="card-body"><h5 class="card-title">Cliente: '+ordiniConfermati[i].cliente.nome +
            ' ' + ordiniConfermati[i].cliente.cognome + '</h5><p class="card-text">Aula: '+
            ordiniConfermati[i].idAula + '</p><a href="#" class="btn btn-success consegna">Accetta <i class="fas fa-check"></i></a>'+
            '<a href="#" class="btn btn-secondary">Ignora <i class="far fa-times-circle"></i></a></div></div>');
    }
  }

}

$.ajax({
  url: "../controller/order_for_messenger.php",
  type: "POST",
  data: {'stato' : 'in consegna'},
  success: function(response){
    var json = JSON.parse(response);
    for(var i = 0; i < json.length; i++){
      ordiniInConsegna[i] = json[i];
    }


    populateCardInConsegna();
    $('.consegnato').on('click', function() {
      index = $(this).parent().parent().index();
      $.ajax({
        url: "../controller/fattorino_modifica_stato.php",
        type: "POST",
        data:{'stato' : 'consegnato', 'idOrdine' : ordiniInConsegna[index].idOrdine},
        success: function(response){
          location.reload();
        }

      });
    });
  }
});

function populateCardInConsegna(){
  $('#shipping').empty();
  if(ordiniInConsegna.length == 0){
      $('#shipping').append('<h4>Non hai ancora ordini da consegnare</h4>');
  }
  else{
    for(var i = 0; i < ordiniInConsegna.length; i++){
      $('#shipping').append('<div class="card"><div class="card-header">Id Ordine: '+ ordiniInConsegna[i].idOrdine+'</div>'+
          '<div class="card-body"><h5 class="card-title">Cliente:'+ordiniInConsegna[i].cliente.nome +
            ' ' + ordiniInConsegna[i].cliente.cognome + '</h5><p class="card-text">Aula: '+
            ordiniInConsegna[i].idAula + '</p><a href="#" class="btn btn-success consegnato">Consegnato <i class="fas fa-utensils"></i></a></div></div>');
    }
  }

}

$.ajax({
  url: "../controller/order_consegnati_o_letti.php",
  type: "POST",
  success: function(response){
    var json = JSON.parse(response);

      for(var i = 0; i < json.length; i++){
      ordiniConsegnati[i] = json[i];
    }

    populateConsegnati();
  }
});

function populateConsegnati(){
  $('#shipped').empty();
  if(ordiniConsegnati.length == 0){
      $('#shipped').append('<h4>Non hai ancora ordini consegnati</h4>');
  }
  else{
    for(var i = 0; i < ordiniConsegnati.length; i++){
      $('#shipped').append('<li class="list-group-item">Id Ordine: ' + ordiniConsegnati[i].idOrdine + '</li>');
    }

  }

}




});
