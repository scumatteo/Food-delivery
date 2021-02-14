$(document).ready(function() {

  var aule = [];

  $.ajax({
    url: '../controller/aule.php',
    type: 'POST',
    success: function(response){
	  var json = JSON.parse(response);
	  for(var i = 0; i < json.length; i++){
	      aule[i] = json[i];
	  }
	  for(var i = 0; i < aule.length; i++){
		$('#aula-list').append('<a href="#">Aula: '+aule[i].idAula+', locazione: '+aule[i].locazione+'<br/></a>');
	  }
    }
  });

  $('#edit-person').on('click', function() {
    var email = $('.edit:eq(0) input').val();
    var new_email = $('.edit:eq(1) input').val();
    var pass = $('.edit:eq(2) input').val();
    var nome = $('.edit:eq(3) input').val();
    var cognome = $('.edit:eq(4) input').val();
    var tipo = $('select option:selected').val();
    $.ajax({
      url: '../controller/modify_person.php',
      type: 'POST',
      data: {email: email, new_email: new_email, password: pass, nome: nome, cognome: cognome,
              tipo: tipo},
      success: function(response){
        console.log(response);
        if(response == "okok"){
          $('.edit-modal h2').text('Modifica riuscita');
          function reload(){
            location.reload();
            }
            setTimeout(reload, 1000);
          }
        else{
          $('.edit-modal h2').text('Errore');
        }
      }
    });

  });

  $('#inserisci-aula').on('click', function() {
    var idAula = $('.insert-aula:eq(0) input').val();
    var locazione = $('.insert-aula:eq(1) input').val();
    $.ajax({
      url: '../controller/insert_aula.php',
      type: 'POST',
      data: {idAula: idAula, locazione: locazione},
      success: function(response){
        if(response == "ok"){
          $('.insert-modal h2').text('Modifica riuscita');
          function reload(){
            location.reload();
            }
            setTimeout(reload, 1000);
          }
          else{
            $('.insert-modal h2').text('Errore');
          }
        }

    });

  });

  $('.edit-account-button').on('click', function() {
    showModal('.edit-modal');
  });

  $('.add-aula-button').on('click', function() {
    showModal('.insert-modal');
  });

  $('.edit-modal-close').on('click', function() {
    hideModal('.edit-modal');
  });

  $('.insert-modal-close').on('click', function() {
    hideModal('.insert-modal');
  });

  function showModal(modal) {
    $(modal).css('opacity', '1').css('visibility', 'visible');
  }

  function hideModal(modal) {
    $(modal).css('opacity', '0').css('visibility', 'hidden');
  }

});
