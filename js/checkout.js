$(document).ready(function() {

 var url = new URL(window.location.href);
  var forn_email = url.searchParams.get("email");

  var cart = [];
  var aule = [];
  var maxIdOrdine;

  $.ajax({
    url: "../controller/product_in_cart_list.php",
    type: "POST",
    success: function(response){
		if(response.length>0){
			var json = JSON.parse(response);
      for(var i = 0; i < json.length; i++){
        cart[i] = json[i];
      }
		}


      getAule();
      getMaxIdOrder();
    }
  });

  function getAule() {
    $.ajax({
      url: "../controller/aule.php",
      success: function(response){
        var json = JSON.parse(response);
        for(var i = 0; i < json.length; i++){
          aule[i] = json[i];
        }
        populateProducts();
        populateCheckoutPanel();
      }
    });
  }

  function getMaxIdOrder() {
    $.ajax({
      url: "../controller/max_id_order.php",
      success: function(response){
        maxIdOrdine = response;
      }
    });
  }

  function insertOrder() {
	  var metodo = $('.payment input:checked').val();
	  if(metodo != undefined){
		var aula = $('.choose-place option:selected').val();
	  var ora = $('.choose-hour input').val();
	  var data = $('#datepicker').val();
	  if(ora != undefined && data!=undefined && data != "" && ora != "" && cart.length>0){
		  var prezzo_tot = 0;
	  for(var i = 0; i < cart.length; i++){
		  prezzo_tot = (cart[i].porzioni * cart[i].prezzo_tot) + prezzo_tot;
	  }
    $.ajax({
      url: "../controller/delete_product_in_carrello.php",
      type: "POST",
    });
    $.ajax({
      url: "../controller/insert_order.php",
      type: "POST",
      data: {
        "idOrdine" : parseInt(maxIdOrdine), "forn_email" : forn_email, "prezzo" : prezzo_tot, "ora" : ora, "data" : data, "idAula": aula
      },
      success: function(response){
        console.log(response);
      }
    });

	for(var i = 0; i < cart.length; i++){
	  $.ajax({
      url: "../controller/insert_ordered_product.php",
      type: "POST",
      data: {
        "idProdotto_ordinato" : parseInt(maxIdOrdine), "forn_email": forn_email, "idProdotto": cart[i].idProdotto, "porzioni": cart[i].porzioni,
		"prezzo": cart[i].prezzo_tot, "nome" : cart[i].nome, "descrizione" : cart[i].descrizione
    	}
    });
	}

	  }
	  else if(cart.length == 0){
		  alert("Carrello vuoto");
	  }
	  else{
		  alert("Selezionare data e ora");
	  }
	  }
    window.location.replace("../src/registered_homepage.php");
  }

  function populateProducts() {

    var productsElements = [];

    cart.forEach(function(item, index) {
      var productItem = $('<div class="product-item"></div>');
      var nome = $('<div class="product-name">' + item.nome + '</div>');
      var descrizione = $('<div class="product-description">' + item.descrizione + '</div>');
      var prezzo = $('<div class="product-price"> Tot: ' + item.prezzo_tot + '€</div>');
      var tipo = $('<div class="product-type">Tipo: ' + item.tipo + '</div>');
      var immagine = $('<div class="product-image"><img src="' + item.immagine + '" alt = "product image"></div>');
      var quantita = $('<div class="product-counter"> Quantità: ' + item.porzioni + '</div>');

      productItem.append([immagine, nome, tipo, descrizione, quantita, prezzo]);
      productsElements.push(productItem);
    });

    $('.products-container').append(productsElements);

  }

  function populateCheckoutPanel() {
    var auleOptions = [];
    aule.forEach(function(item, index) {
      var option = $('<option>' + item.idAula + '</option>');
      auleOptions.push(option);
    });
    $('.choose-place').find('select').append(auleOptions);
  }

  $('.checkout-button').on('click', function(event) {
    alert("Il pagamento su questo sito è da considerarsi solamente una demo. L'ordine viene processato senza un pagamento effettivo.");
    insertOrder();
  });

  $('#datepicker').datepicker({
    minDate: '-0',
    maxDate: '+15d'
  });

});
