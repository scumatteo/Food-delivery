$(document).ready(function() {
  var filter = false;
  var url = new URL(window.location.href);
  var email_selected = url.searchParams.get("email");
  var products = [];
  var filters = [];

$.ajax({
  url: "../controller/all_types_for_restaurant.php",
  type: "POST",
  data: {"email" : email_selected},
  success: function(response){
    var json = JSON.parse(response);
    for(var i = 0; i < json.length; i++){
      filters[i] = json[i];
    }
    getProductList();
  }

});

  function getProductList() {
    $.ajax({
      url: "../controller/product_list_client.php",
      type: "POST",
      data: {"email" : email_selected},
      success: function(response){

        var json = JSON.parse(response);
        for(var i = 0; i < json.length; i++){
          products[i] = json[i];
        }

        populateProducts();
        populateFilters();
        eventListeners();

      }
    });
  }

  function eventListeners() {
    $('.product-button').on('click', function() {
      if(email_selected != email){
        $.ajax({
          url: "../controller/delete_product_in_carrello.php",
          type: "POST",
          success: function(){

          }
        });
      }
	  var index = $(this).parent().index()-1;
      var product_clicked = products[$(this).parent().index()-1];
      var quantità = $('.product-counter:eq('+index+')').val();
	  var prezzo = products[index].prezzo * $('.product-counter:eq('+index+')').val();
	  if(quantità != 0 && quantità != undefined){
		   $.ajax({
        url: "../controller/insert_product_cart.php",
        type: "POST",
        data: {
          "id" : product_clicked.id,
          "prezzo" : prezzo,
          "quantità" : quantità,
        },
        success: function(response){
			alert("Prodotto aggiunto al carrello");
      function reload(){
        location.reload();
      }
      setTimeout(reload, 1000);
        }
      });
	  }
	  else{
		  alert ("Inserire la quantità");
	  }


    });

    $('.product-counter').on('click', function(event) {
      var standardPrice = products[$(this).parent().parent().index()-1].prezzo;
      $(event.currentTarget).parent().find('.product-price').text(standardPrice * $(event.currentTarget).val() + '€');
    });

    $('.filters-container h2').on('click', function() {
      if ($('.filters-container').height() <= 60) {
        $('.filters-container').css('height', 250);
      } else if ($('.filters-container').height() <= 300) {
        $('.filters-container').css('height', 60);
      }
    });

    $(window).on('resize', function() {
      $('.filters-container').css('height', '');
      $('.filters-container').css('height', null);
    });

  }

  function populateProducts() {

    var productsElements = [];

    products.forEach(function(item, index) {
      var productItem = $('<div class="product-item"></div>');
      var nome = $('<div class="product-name">' + item.nome + '</div>');
      var descrizione = $('<div class="product-description">' + item.descrizione + '</div>');
      var prezzo = $('<div class="product-price">' + item.prezzo + '€</div>');
      var tipo = $('<div class="product-type">' + item.tipo + '</div>');
      var immagine = $('<div class="product-image"><img src="' + item.immagine + '" alt = "image of the product"></div>');
      var quantita = $('<label>Quantità: <input class="product-counter" type="number" min="1" value="1"></label>');
      var button = $('<button class="product-button btn btn-success" type="button">Add to Cart</button>');
      button.data('productSelected', item.id);

      productItem.append([immagine, nome, tipo, descrizione, prezzo, quantita, button]);
      productsElements.push(productItem);
    });

    $('.products-container').append(productsElements);

  }

  function populateFilters() {

    var filtersElements = [];

    filters.forEach(function(item, index) {
      var filterItem = $('<div class="filter-item"></div>');

      var radio = $('<input id="' + item + '" type="radio" name="filters" value="' + item + '"></input>');
      var label = $('<label for="' + item + '"> ' + item + '</label>');

      filterItem.append([radio, label]);
      filtersElements.push(filterItem);
    });

    var clearFilter = $('<button class="clear-filters btn btn-secondary" type="button">Clear</button>');
    var applyFilter = $('<button class="apply-filters btn btn-success" type="button">Apply</button>');
    var filtersButtons  = $('<div class="filters-buttons"></div>').append([clearFilter, applyFilter]);

    clearFilter.on('click', function() {
      clearFilters();
    });

    applyFilter.on('click', function() {
      applyFilters();
    });

    $('.filters-container').append(filtersElements, filtersButtons);

  }

  function clearFilters() {
    $('input:checked').removeAttr('checked');
    $('input[type="radio"]').prop('checked', false);
    $('.product-item').each(function(index, item) {
      $(item).removeClass('display-none');
    });
  }

  function applyFilters() {
    if ($('input[name=filters]:checked').length > 0) {
      var checkedValue = $('input[name=filters]:checked').val().toLowerCase();
      $('.product-item').each(function(index, item) {
        $(item).removeClass('display-none');
      });
      $('.product-item').each(function(index, item) {
        var productType = $(item).find('.product-type');
        if (productType.text().toLowerCase() != checkedValue) {
          $(item).addClass('display-none');
        }
      });
    }
  }



  $('#delete-cart').on('click', function() {
	  $.ajax({
		  url: "../controller/delete_product_in_carrello.php",
		  type: "POST",
		  success: function(){
			  location.reload();
		  }
      });

  });

});
