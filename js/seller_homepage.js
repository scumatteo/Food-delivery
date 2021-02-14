$("#accountList").click(function(){
  $(".dropdown-content").dropdown("toogle");
});

$(document).ready(function() {

  var fattorini_liberi = [];
  var ordiniNonConfermati = [];

  var ordiniConfermati =  [];

  $.ajax({
    url: "../controller/all_order_seller.php",
    type: "POST",
    success: function(response){
      var json = JSON.parse(response);
      for(var i = 0; i < json.length; i++){
        if(json[i].Stato == "non confermato"){
          ordiniNonConfermati.push(json[i]);
        }
        else{
          ordiniConfermati.push(json[i]);
        }
      }
      populateOrder();
      populateConfirmedOrder();
      $('.consegna').on('click', function() {
        index = $(this).parent().parent().index();
        controllerAccept(index);
      });
    }
  });

  function populateOrder(){
    $('#todo').empty();
    if(ordiniNonConfermati.length == 0){
        $('#todo').append('<h4>Non hai ancora ordini in arrivo</h4>');
    }
    else{
      $('.prod').html('');
      for(var i = 0; i < ordiniNonConfermati.length; i++){
        $('#todo').append('<div class="card"><div class="card-header">Id Ordine: '+ ordiniNonConfermati[i].idOrdine+'</div>'+
            '<div class="card-body"><h5 class="card-title">Cliente: '+ordiniNonConfermati[i].Nome +
              ' ' + ordiniNonConfermati[i].Cognome + '</h5><p class="card-text">Aula: '+
              ordiniNonConfermati[i].Aula + '</p><p class="card-text">Data: '+ ordiniNonConfermati[i].Data +
              '</p><p class="card-text">Ora: '+ ordiniNonConfermati[i].Ora + '</p><p class="card-text">Prezzo: '
              + ordiniNonConfermati[i].Prezzo_totale + '€</p><p class="card-text prod">Prodotto: <br/>'+
              '</p><a href="#" class="btn btn-success consegna">Inoltra ai fattorini <i class="fas fa-check"></i></a></div></div>');
        }
        for(var i = 0; i < ordiniNonConfermati.length; i++){
          for(var n = 0; n < ordiniNonConfermati[i].Prodotti.length; n++){
            $('.prod:eq('+i+')').append('Id prodotto: '+ordiniNonConfermati[i].Prodotti[n].idProdotto +
             ', porzioni: '+ ordiniNonConfermati[i].Prodotti[n].porzioni+', nome: ' + ordiniNonConfermati[i].Prodotti[n].nome +', descrizione: ' + ordiniNonConfermati[i].Prodotti[n].descrizione
             + '<br/>');
          }
        }

      }
    }

  function populateConfirmedOrder(){
    $('#stato').empty();
    if(ordiniConfermati.length == 0){
        $('#stato').append('<h4>Non hai ordini in consegna</h4>');
    }
    else{
      $('.prod-text').html('');
      for(var i = 0; i < ordiniConfermati.length; i++){
        $('#stato').append('<div class="card-state"><div class="card-state-header">Id Ordine: '+ ordiniConfermati[i].idOrdine+'</div>'+
            '<div class="card-state-body"><h5 class="card-state-title">Cliente: '+ordiniConfermati[i].Nome +
              ' ' + ordiniConfermati[i].Cognome + '</h5><p class="card-state-text">Aula: '+
              ordiniConfermati[i].Aula + '</p><p class="card-state-text">Data: '+ ordiniConfermati[i].Data +
              '</p><p class="card-state-text">Ora: '+ ordiniConfermati[i].Ora + '</p><p class="card-text">Prezzo: '
              + ordiniConfermati[i].Prezzo_totale + '€</p><p class="card-text prod-text">Prodotti: <br/>'+
              '</p><p>Stato: '+ ordiniConfermati[i].Stato +' <i class="fas fa-circle" id="circle" title="image of different color for each state of the order"></p></div></div>');
        }
        for(var i = 0; i < ordiniConfermati.length; i++){
          for(var n = 0; n < ordiniConfermati[i].Prodotti.length; n++){
            $('.prod-text:eq('+i+')').append('Id prodotto '+ordiniConfermati[i].Prodotti[n].idProdotto +
             ', nome ' + ordiniConfermati[i].Prodotti[n].nome +', descrizione ' + ordiniConfermati[i].Prodotti[n].descrizione
             + '<br/>');
          }
        }

      }
      for(var i = 0; i < ordiniConfermati.length; i++){
      if(ordiniConfermati[i].Stato == 'consegnato' || ordiniConfermati[i].Stato == "letto"){
        $('.card-state:eq('+i+')').find('.fa-circle').css('color', '#28a745');
      }
      else if(ordiniConfermati[i].Stato == 'in consegna'){
        $('.card-state:eq('+i+')').find('.fa-circle').css('color', 'orange');
      }
      else if(ordiniConfermati[i].Stato == 'confermato'){
        $('.card-state:eq('+i+')').find('.fa-circle').css('color', 'red');
      }
    }
    }

    function controllerAccept(index){
      $.ajax({
        url: "../controller/confirm_order_seller.php",
        type: "POST",
        data: {"Cliente":ordiniNonConfermati[index].Cliente,
        "idOrdine": ordiniNonConfermati[index].idOrdine},
        success: function(response){
          location.reload();
        }
      });
  }


});
