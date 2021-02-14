$(document).ready(function() {
  var notifiche = [];
  var categories = [];
  var sellers = [];
  var sellers_for_type = [];
  var filter = false;


  //$("#accountButton").click(function(){
    //$("#account-menu").dropdown("toogle");
  //});

  $.ajax({
    url:"../controller/all_types.php",
    success:function(result){
      var json = JSON.parse(result);

      for(var i = 0; i < json.length; i++){
        categories[i] = json[i];
      }

      for(var i = 0; i < categories.length; i++) {
        $("#navbar-categories").append("<a class='nav-link mr-3 type' href='#'>"+ categories[i] + "</a>");
      }
      $("#navbar-categories").append("<a class='nav-link mr-3 no-filter' href='#'>Nessun filtro</a>");

      $('.type').on('click', function() {
        filter = true;
        var type = $(this).text();
        $.ajax({
          url: "../controller/restaurant_for_type.php",
          type: "POST",
          data: {'tipo' : type},
          success:function(result){
            var json = JSON.parse(result);
            for(var i = 0; i < json.length; i++){
              sellers_for_type[i] = json[i];
            }
            $('.card-group').empty();
            for(var i = 0; i < sellers_for_type.length; i++) {
              $(".card-group").append("<div class='card'><h5 class='card-title'>" + sellers_for_type[i].ristorante +
              "</h5> <img class='card-img-top' src="+ sellers_for_type[i].immagine +
              "><div class='card-body'><p class='card-text'>"+sellers_for_type[i].descrizione+
              "</p><p class='card-text'><small class='text-muted'><i class='fas fa-phone'></i> "+ sellers_for_type[i].telefono+ "</small></p></div></div>");
            }
            cardClick();
          }
        });
      });

      $('.no-filter').on('click', function() {
        filter = false;
        $.ajax({
          url:"../controller/all_restaurant.php",
          success:function(result){
            var json = JSON.parse(result);
            for(var i = 0; i < json.length; i++){
              sellers[i] = json[i];
            }
            $('.card-group').empty();
            for(var i = 0; i < sellers.length; i++) {
              $(".card-group").append("<div class='card'><h5 class='card-title'>" + sellers[i].ristorante +
              "</h5> <img class='card-img-top' src="+ sellers[i].immagine +
              "><div class='card-body'><p class='card-text'>"+sellers[i].descrizione+
              "</p><p class='card-text'><small class='text-muted'><i class='fas fa-phone'></i> "+ sellers[i].telefono+ "</small></p></div></div>");
            }
            cardClick();
          }
        });
      });
    }
  });

  $.ajax({
    url:"../controller/all_restaurant.php",
    success:function(result){
      var json = JSON.parse(result);
      for(var i = 0; i < json.length; i++){
        sellers[i] = json[i];
      }

      for(var i = 0; i < sellers.length; i++) {
        $(".card-group").append("<div class='card'><h5 class='card-title'>" + sellers[i].ristorante +
        "</h5> <img class='card-img-top' src="+ sellers[i].immagine +
        " alt='image of the restaurant'><div class='card-body'><p class='card-text'>"+sellers[i].descrizione+
        "</p><p class='card-text'><small class='text-muted'><i class='fas fa-phone' title='phone number'></i> "+ sellers[i].telefono+ "</small></p></div></div>");
      }
      cardClick();

    }
  });

function cardClick(){

  $('.card').on('click', function() {
		alert("Aggiungendo al carrello un prodotto di un altro fornitore, i precedenti saranno rimossi!");
    if(filter){
      email_selected = sellers_for_type[$(this).index()].email;
      window.location.replace("../src/choose-product.php?email="+email_selected);
    }
    else{
      email_selected = sellers[$(this).index()].email;
      window.location.replace("../src/choose-product.php?email="+email_selected);
    }
  //
  });



}

setInterval(function(){
	$.ajax({
		url: "../controller/notifiche_consegnato.php",
		type: "POST",
		success: function(response){
			var json = JSON.parse(response);
      for (var i = 0; i < json.length; i++){
        notifiche[i] = json[i];
      }
      $('#notification-list').empty();
      if(notifiche.length > 0){
        $('.badge').html(notifiche.length);
      }

      for (var i = 0; i < notifiche.length; i++){
        $('#notification-list').append('<a href="#">Consegnato ordine con data '+notifiche[i][0].data+' e ora '+notifiche[i][0].ora+' in aula '+notifiche[i][0].idAula);
      }

		}
	});
},2000);

$('#notification-list').on('click', function() {
  for(var i = 0; i < notifiche.length; i++){
    $.ajax({
      url: "../controller/fattorino_modifica_stato.php",
      type: "POST",
      data: {stato: "letto", idOrdine: notifiche[i][0].idOrdine},
      success: function(){
        $('.badge').empty();
        notifiche = [];
      }
    });
  }
});

});
