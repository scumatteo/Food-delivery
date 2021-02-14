$("#accountList").click(function(){
  $(".dropdown-content").dropdown("toogle");
});

$(document).ready(function() {

  var text;
  var last_trash;

  var tipo = [
    "Pasta", "Pizza", "Sushi", "Carne", "Pesce", "Frutta", "Verdura", "Fit",
    "Veg", "Formaggio", "Bibita", "Acqua", "Dolce", "Hamburger", "Salsa"
  ];

  var prod = [
    "Codice","Immagine","Nome","Prezzo","Tipo","Descrizione",
  ];

  var prodotto={
    immagine:'',
    nome: '',
    prezzo: '',
    tipo:'',
    descrizione: '',
  };

  var prodotto_inserito={
    id:'',
    immagine:'',
    nome: '',
    prezzo: '',
    tipo:'',
    descrizione: '',
  };

  var prodotti= [];

  var inputProdotti = [];

  $.ajax({
    url: "../controller/product_list_seller.php",
    type: "POST",
    success: function(response){

      var json = JSON.parse(response);

      for(var i = 0; i < json.length; i++){
        prodotti[i] = json[i];
      }

      populateList();


      $('#edit').on('click', function() {
        $('.product-modal-content h2').html("Modifica");
        var index = $(this).parent().parent().parent().prevAll('.product-wrapper').length;
        populateProductFromData(index);
        showProductModal();
      });

      $('#delete').on('click', function() {
        $('.trash-modal-content h2').html("Elimina");
        var index = $(this).parent().parent().parent().prevAll('.product-wrapper').length;
        last_trash = index;
        populateTrashFromData(index);
        showTrashModal();
      });

      $('#insertProd').on('click', function() {
        populateInsertModal();
        showInsertModal();
      });

      $('.product-modal-close').on('click', function () {

        hideProductModal();
      });

      $('.trash-modal-close').on('click', function () {
        for(var i = 0; i < Object.keys(prodotto_inserito).length; i++){
          $('.trash-product:eq('+i+') p').text(text);
        }
        hideTrashModal();
      });

      $('.insert-modal-close').on('click', function () {
        hideInsertModal();
      });



      $('#elimina').on('click', function() {
        prodotto_inserito.id = prodotti[last_trash].idProdotto;
        $.ajax({
          url: "../controller/delete_product.php",
          type: "POST",
          dataType: "text",
          data: prodotto_inserito,
          success: function(response){
            if(response == "ok"){
              $('.trash-modal h2').html("Cancellazione avvenuta con successo!");
              function reload(){
                location.reload();
              }
              setTimeout(reload, 1000);
            }
          },
          error: function(err){
            $('.trash-modal h2').html("Errore nel db!");
          }
        });
      });

      $('#salva').on('click', function() {
        prodotto_inserito.id = parseInt($('.edit-product:eq(0) input').val());
        prodotto_inserito.immagine = $('.edit-product:eq(1) input').val();
        prodotto_inserito.nome = $('.edit-product:eq(2) input').val();
        prodotto_inserito.prezzo = parseFloat($('.edit-product:eq(3) input').val());
        prodotto_inserito.tipo = $('.edit-product:eq(4) option:selected').text();
        prodotto_inserito.descrizione = $('.edit-product:eq(5) input').val();
        if($.isNumeric(prodotto_inserito.prezzo)){
          $.ajax({
            url: "../controller/modify_product.php",
            type: "POST",
            dataType: "text",
            data: prodotto_inserito,
            success: function(response){
              if(response == "ok"){
                $('.product-modal h2').html("Modifica avvenuta con successo!");
                function reload(){
                  location.reload();
                }
                setTimeout(reload, 1000);
              }
            },
            error: function(err){
              $('.product-modal h2').html("Errore nel db!");
            }
          });
        }
        else{
          $('.product-modal h2').html("Attenzione ai campi numerici!");
        }
      });

      $('#inserisci').on('click', function() {
        prodotto.immagine = $('.insert-product:eq(0) input').val();
        prodotto.nome = $('.insert-product:eq(1) input').val();
        prodotto.prezzo = $('.insert-product:eq(2) input').val();
        prodotto.tipo = $('.insert-product:eq(3) option:selected').text();
        prodotto.descrizione = $('.insert-product:eq(4) input').val();
        if($.isNumeric(prodotto.prezzo)){
          $.ajax({
            url: "../controller/insert_product.php",
            type: "POST",
            dataType: "text",
            data: prodotto,
            success: function(response){
              console.log(response);
              if(response == "ok"){
                $('.insert-modal h2').html("Inserimento avvenuto con successo!");
                function reload(){
                  location.reload();
                }
                setTimeout(reload, 1000);
              }
              else{
                $('.insert-modal h2').html("Errore! Campi mancanti");
              }

            },
            error: function(err){
              $('.insert-modal h2').html("Errore nel db!");
            }
          });
        }
        else{
          $('.insert-modal h2').html("Attenzione ai campi numerici!");
        }
      });
    },
    error: function(err){
      console.log(err);
    }
  });

  function hideProductModal() {
    $('.product-modal').css('opacity', '0').css('visibility', 'hidden');
  }

  function showProductModal() {
    $('.product-modal').css('opacity', '1').css('visibility', 'visible');
  }

  function hideTrashModal() {
    $('.trash-modal').css('opacity', '0').css('visibility', 'hidden');
  }

  function showTrashModal() {
    $('.trash-modal').css('opacity', '1').css('visibility', 'visible');
  }

  function hideInsertModal() {
    $('.insert-modal').css('opacity', '0').css('visibility', 'hidden');
  }

  function showInsertModal() {
    $('.insert-modal').css('opacity', '1').css('visibility', 'visible');
  }

  function populateProductFromData(index){
    for(var i = 0; i < tipo.length; i++){
      $('select').append('<option>'+tipo[i]+'</option>');
    }
    $('select').val(prodotti[index].tipo);
    for(var i = 0; i < Object.keys(prodotto_inserito).length; i++){
      $('.edit-product:eq('+i+')').find('input').val(prodotti[index][Object.keys(prodotti[index])[i]]);
    }
    $('.edit-product:eq(0)').find('input').prop('readonly', 'true');
  }

  function populateTrashFromData(index){

      for(var i = 0; i < Object.keys(prodotti[index]).length; i++){
        text = $('.trash-product:eq('+i+') p').text();
        $('.trash-product:eq('+i+') p').html(text + " " + prodotti[index][Object.keys(prodotti[index])[i]]);
      }

  }

  function populateInsertModal(){
    for(var i = 0; i < tipo.length; i++){
      $('select').append('<option>'+tipo[i]+'</option>');
    }
  }

  function populateList(){
    $('#lista').empty();
    if(prodotti.length == 0){
        $('#lista').append('<h4>Non hai ancora prodotti inseriti</h4>');
    }
    else{
      for(var i = 0; i < prodotti.length; i++){
        $('#lista').append('<div class="card"><div class="card-header">Id Prodotto: '+ prodotti[i].idProdotto+'</div>'+
            '<div class="card-body"><h5 class="card-title">Nome: '+prodotti[i].nome +
              '</h5><p class="card-text">Prezzo: '+ prodotti[i].prezzo + '</p>' +
              '<p class="card-text">Tipo: '+ prodotti[i].tipo + '</p>' +
              '<p class="card-text">Immagine: '+ prodotti[i].immagine + '</p>' +
              '<p class="card-text">Descrizione: '+ prodotti[i].descrizione + '</p>'+
              '</p><a href="#" id="edit" class="btn btn-primary">Modifica <i class="far fa-edit"></i></a>'+
              '<a href="#" id="delete" class="btn btn-danger">Elimina <i class="fas fa-trash-alt"></i></a></div></div>');
      }
    }
  }
});
