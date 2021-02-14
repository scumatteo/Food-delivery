$(document).ready(function() {

  var register = false;

  // this var contains all the input objects that will be displayed
  var userInputElements = [
    {
      input: '<select><option selected disabled>Scegli...</option><option value="cliente">Cliente</option><option value="fornitore">Fornitore</option><option value="fattorino">Fattorino</option></select>',
      title: 'Che tipo di utente sei?',
      info: 'type'
    },
    {
      input: '<input for="email" type="email" placeholder="email@example.com">',
      title: 'Inserisci la tua email',
      info: 'email'
    },
    {
      input: '<input for="password" type="password" placeholder="">',
      title: 'Inserisci la tua password',
      info: 'password'
    },
    {
      input: '<input for="name" type="text" placeholder="">',
      title: 'Inserisci il tuo nome',
      info: 'name'
    },
    {
      input: '<input for="surname" type="text" placeholder="">',
      title: 'Inserisci il tuo cognome',
      info: 'surname'
    },
  ];

  var fornitoreInputElements = [
    {
      input: '<input for="cf" type="text" placeholder="">',
      title: 'Inserisci il tuo Codice Fiscale',
      info: 'cf'
    },
    {
      input: '<input for="piva" type="text" placeholder="">',
      title: 'Inserisci la tua Partita IVA',
      info: 'piva'
    },
    {
      input: '<input for="telefono" type="text" placeholder="">',
      title: 'Inserisci il tuo numero di telefono',
      info: 'tel'
    },
    {
      input: '<input for="ristornate" type="text" placeholder="">',
      title: 'Inserisci il nome della tua attività',
      info: 'ristorante'
    },
    {
      input: '<input for="immagine" type="text" placeholder="">',
      title: 'Inserisci un indirizzo di un immagine per la tua pagina',
      info: 'immagine'
    },
    {
      input: '<input for="descrizione" type="text" placeholder="">',
      title: 'Inserisci una breve descrizione della tua attività',
      info: 'descrizione'
    },
  ];

  var fattorinoInputElements = [
    {
      input: '<input for="email" type="text" placeholder="">',
      title: 'Inserisci la mail del tuo datore di lavoro',
      info: 'email_forn'
    },
  ];

  //inputElements la tengo come variabile a parte e la inizializzo uguale a userInputElements
  var inputElements = userInputElements.slice();

  var loginElements = [
    {
      input: '<input for="email" type="email" placeholder="email@example.com">',
      title: 'Inserisci la tua email',
      info: 'email'
    },
    {
      input: '<input for="password" type="password" placeholder="">',
      title: 'Inserisci la tua password',
      info: 'password'
    },
  ];

  // this var will be filled with the user info to be sent to the db
  var userInfo = {};

  var loginInfo = {};

  $(document).on('keydown', function(event) {
    if (event.keyCode === 27) {   // close modal on esc key pressed
      hideModal();
      hideLoginModal();
    }
    else if(event.keyCode == 13){ //va avanti con invio
      if(register){
        nextInput();
      }
      else{
        nextLoginInput();
      }

    }
  });

  $('#registerButton').on('click', function() {
    register = true;
    $('.user-modal h2').html('Registrati');
    if (userInfo.hasOwnProperty('type')) {  // if the user already filled some info just resume from that point
      populatePopupFromData();
    } else {
      // first open of the popup (use the first input in the array)
      $('.user-modal p').html(userInputElements[0].title);
      $('#popupInput').html(userInputElements[0].input);
      $('#popupInput').data('content', 0);  // bind input array index data to the input element in DOM
    }
    setTimeout(function() {
      $($('#popupInput').children()[0]).focus();
    }, 200);
    showModal();
    animatePopupContentUp();
  });

  $('#loginButton').on('click', function() {
    $('.login-modal h2').html('Accedi');
    $('.login-modal p').html(loginElements[0].title);
    $('#loginPopupInput').html(loginElements[0].input);
    $('#loginPopupInput').data('content', 0);  // bind input array index data to the input element in DOM
    $('.breadcrumb-container-login').empty();
    loginElements.forEach(function() {
      $('.breadcrumb-container-login').append('<div class="inactive"></div>');
    });
    $('.inactive:first-child').attr('class', 'active-login'); //attiva il primo div
    setTimeout(function() {
      $($('#loginPopupInput').children()[0]).focus();
    }, 200);
    showLoginModal();
    animateLoginPopupContentUp();
  });


  $('#avanti').on('click', function () {
    //se l'utente ha già inserito il tipo e lo modifica, il conteggio dei content torna a 0
    if ($('.user-modal p').html() === inputElements[0].title && userInfo.hasOwnProperty('type') && $('#popupInput').children().val() != userInfo.type){
      $('#popupInput').data('content', 0);
      inputElements = userInputElements.slice();
    }
    nextInput();
  });

  $('#loginAvanti').on('click', function() {
    nextLoginInput();
  });

  $('.modal-close').on('click', function () {
    register = false;
    hideModal();
  });

  $('.login-modal-close').on('click', function () {
    hideLoginModal();
  });

  //se viene cliccato sui div attivati mostra la form di quel div
  $(document).on('click', '.active', function() {
   if ($(this).index() === 0) {
     $('#popupInput').data('content', 0);
     $('.user-modal p').html(inputElements[0].title);
     $('#popupInput').html(inputElements[0].input);
     //setta già il tipo scelto
     if(userInfo.hasOwnProperty('type')){
       $('select').val(userInfo.type);
     }
   }
   else if ($(this).index() === 1) {
     $('#popupInput').data('content', 1);
     $('.user-modal p').html(inputElements[1].title);
     $('#popupInput').html(inputElements[1].input);
     $('input').val(userInfo[inputElements[1].info]);
   }
   else if ($(this).index() === 2) {
     $('#popupInput').data('content', 2);
     $('.user-modal p').html(inputElements[2].title);
     $('#popupInput').html(inputElements[2].input);
     $('input').val(userInfo[inputElements[2].info]);
   }
   else if ($(this).index() === 3) {
     $('#popupInput').data('content', 3);
     $('.user-modal p').html(inputElements[3].title);
     $('#popupInput').html(inputElements[3].input);
     $('input').val(userInfo[inputElements[3].info]);
   }
   else if ($(this).index() === 4) {
     $('#popupInput').data('content', 4);
     $('.user-modal p').html(inputElements[4].title);
     $('#popupInput').html(inputElements[4].input);
     $('input').val(userInfo[inputElements[4].info]);
   }
   if(userInfo[inputElements[0].info] === 'fornitore'){
     if ($(this).index() === 5) {
       $('#popupInput').data('content', 5);
       $('.user-modal p').html(inputElements[5].title);
       $('#popupInput').html(inputElements[5].input);
       $('input').val(userInfo[inputElements[5].info]);
     }
     if ($(this).index() === 6) {
       $('#popupInput').data('content', 6);
       $('.user-modal p').html(inputElements[6].title);
       $('#popupInput').html(inputElements[6].input);
       $('input').val(userInfo[inputElements[6].info]);
     }
     if ($(this).index() === 7) {
       $('#popupInput').data('content', 7);
       $('.user-modal p').html(inputElements[7].title);
       $('#popupInput').html(inputElements[7].input);
       $('input').val(userInfo[inputElements[7].info]);
     }
     if ($(this).index() === 8) {
       $('#popupInput').data('content', 8);
       $('.user-modal p').html(inputElements[8].title);
       $('#popupInput').html(inputElements[8].input);
       $('input').val(userInfo[inputElements[8].info]);
     }
     if ($(this).index() === 9) {
       $('#popupInput').data('content', 9);
       $('.user-modal p').html(inputElements[9].title);
       $('#popupInput').html(inputElements[9].input);
       $('input').val(userInfo[inputElements[9].info]);
     }
     if ($(this).index() === 10) {
       $('#popupInput').data('content', 10);
       $('.user-modal p').html(inputElements[10].title);
       $('#popupInput').html(inputElements[10].input);
       $('input').val(userInfo[inputElements[10].info]);
     }
   }
   else if(userInfo[inputElements[0].info] === 'fattorino'){
     if ($(this).index() === 5) {
       $('#popupInput').data('content', 5);
       $('.user-modal p').html(inputElements[5].title);
       $('#popupInput').html(inputElements[5].input);
       $('input').val(userInfo[inputElements[5].info]);
     }
   }
   animatePopupContentUp();
  });

  $(document).on('click', '.active-login', function() {
   if ($(this).index() === 0) {
     $('#loginPopupInput').data('content', 0);
     $('.login-modal p').html(loginElements[0].title);
     $('#loginPopupInput').html(loginElements[0].input);
     //setta già il tipo scelto
     if(loginInfo.hasOwnProperty('email')){
       $('input').val(loginInfo.email);
     }
   }
   else if($(this).index() === 1) {
     $('#loginPopupInput').data('content', 1);
     $('.login-modal p').html(loginElements[1].title);
     $('#loginPopupInput').html(loginElements[1].input);
     //setta già il tipo scelto
     if(loginInfo.hasOwnProperty('password')){
       $('input').val(loginInfo.password);
     }
   }
   animateLoginPopupContentUp();
 });

  function animatePopupContentUp() {
    $('.user-modal h2, .user-modal p, .user-modal #popupInput').removeClass('move-up');
    setTimeout(function() {
      $('.user-modal h2').addClass('move-up');
      $('.user-modal p').addClass('move-up').css('animation-delay', '0.2s');
      $('.user-modal #popupInput').addClass('move-up').css('animation-delay', '0.4s');
    }, 200);
  }

  function animateLoginPopupContentUp() {
    $('.login-modal h2, .login-modal p, .login-modal #loginPopupInput').removeClass('move-up');
    setTimeout(function() {
      $('.login-modal h2').addClass('move-up');
      $('.login-modal p').addClass('move-up').css('animation-delay', '0.2s');
      $('.login-modal #loginPopupInput').addClass('move-up').css('animation-delay', '0.4s');
    }, 200);
  }

  function errorAnimatePopup() {
    $('.user-modal-content').css('transition', '0.2s');
    $('.user-modal-content').css('background-color', 'red');
    setTimeout(function() {
      $('.user-modal-content').css('background-color', '#28a745');
    }, 200);$('.user-modal-content').css('transition', '0.2s');
    $('.user-modal-content').css('background-color', 'red');
    setTimeout(function() {
      $('.user-modal-content').css('background-color', '#28a745');
    }, 200);
  }

  function errorLoginAnimatePopup() {
    $('.login-modal-content').css('transition', '0.2s');
    $('.login-modal-content').css('background-color', 'red');
    setTimeout(function() {
      $('.login-modal-content').css('background-color', '#28a745');
    }, 200);$('.login-modal-content').css('transition', '0.2s');
    $('.login-modal-content').css('background-color', 'red');
    setTimeout(function() {
      $('.login-modal-content').css('background-color', '#28a745');
    }, 200);
  }

  function nextInput(){
    var value = $('#popupInput').children().val();
    setTimeout(function() {
      $($('#popupInput').children()[0]).focus();
    }, 200);
    //se sceglie fornitore e non ha già un tipo allora unisce inputElements e fornitoreInputElements
    if ($('#popupInput').data('content') === 0 && value === 'fornitore') {
      if(userInfo.hasOwnProperty('type')){
        if(userInfo.type != 'fornitore'){
          $.merge(inputElements, fornitoreInputElements);
        }
      }
      else{
        $.merge(inputElements, fornitoreInputElements);
      }
    }
    else if ($('#popupInput').data('content') === 0 && value === 'fattorino') {
      if(userInfo.hasOwnProperty('type')){
        if(userInfo.type != 'fornitore'){
          $.merge(inputElements, fattorinoInputElements);
        }
      }
      else{
        $.merge(inputElements, fattorinoInputElements);
      }
    }
    //se ha già il tipo ma è diverso da quello vecchio allora ridisegna i div
    if (inputElements[$('#popupInput').data('content')].info === 'type' && value != userInfo.type){
      $('.breadcrumb-container').empty();
      inputElements.forEach(function() {
        $('.breadcrumb-container').append('<div class="inactive"></div>');
      });
      $('.inactive:first-child').attr('class', 'active'); //attiva il primo div
      //nel caso in cui alcuni div siano già stati attivati perchè i campo erano già inseriti li lascia attivi
      Object.keys(userInfo).forEach(function(){
        $('.active').next().attr('class', 'active');
      });
    }
    if (value != undefined && value != '') {
      if ($('input').attr('type') && $('input').attr('type') == 'email') {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(String(value).toLowerCase())) {
          errorAnimatePopup();
          return;
        }
        
      }
      //se non ha ancora la proprietà che sta per inserire allora attiva il div successivo
      if(!userInfo.hasOwnProperty(inputElements[$('#popupInput').data('content')].info)){
          $('.active').next().attr('class', 'active');
      }
      else{
        delete userInfo[inputElements[$('#popupInput').data('content')].info];
      }
      userInfo[inputElements[$('#popupInput').data('content')].info] = value;// save input current key-value in user info
      if($('#popupInput').data('content') < inputElements.length - 1){
        $('#popupInput').data('content', $('#popupInput').data('content')+1);   // go on next input
        populatePopupFromData();
        animatePopupContentUp();
      }

      else{
        $.ajax({
          url: "../controller/signup.php",
          type: "POST",
          data: userInfo,
          ContentType:"application/json",
                    success: function(response){
                      console.log(response);
                      if(response == "okokok"){
                        $('.user-modal p').html("Registrazione avvenuta con successo!");
                        function reload(){
                          location.reload();
                        }
                        setTimeout(reload, 1000);
                      }
                      else{
                        $('.user-modal p').html("Errore! Utente già registrato");
                      }
                    },
                    error: function(err){
                      $('.user-modal p').html("Errore nel database");
                    }
        });
      }
    } else {
      errorAnimatePopup();
    }
  }

  function nextLoginInput(){
    var value = $('#loginPopupInput').children().val();
    setTimeout(function() {
      $($('#loginPopupInput').children()[0]).focus();
    }, 200);

    //nel caso in cui alcuni div siano già stati attivati perchè i campo erano già inseriti li lascia attivi
    Object.keys(loginInfo).forEach(function(){
      $('.active-login').next().attr('class', 'active-login');
    });
    if (value != undefined && value != ''){
      if(!loginInfo.hasOwnProperty(loginElements[$('#loginPopupInput').data('content')].info)){
          $('.active-login').next().attr('class', 'active-login');
      }
      else{
        delete loginInfo[loginElements[$('#loginPopupInput').data('content')].info];
      }
      loginInfo[loginElements[$('#loginPopupInput').data('content')].info] = value;// save input current key-value in user info
      if($('#loginPopupInput').data('content') < loginElements.length - 1){
        $('#loginPopupInput').data('content', $('#loginPopupInput').data('content')+1);   // go on next input
        populateLoginPopupFromData();
        animateLoginPopupContentUp();
      }
      else{
        $.ajax({
          url: "../controller/login.php",
          type: "POST",
          dataType: "text",
          data: loginInfo,
          ContentType:"application/json",
                  success: function(data){
                    console.log(data);
                    if(data == "cliente"){
                      window.location.replace("../src/registered_homepage.php");
                    }
                    else if(data == "fornitore"){
                      window.location.replace("../src/seller_homepage.php");
                    }
                    else if(data == "fattorino"){
                      window.location.replace("../src/messenger_page.php");
                    }
                    else if(data == "admin"){
                      window.location.replace("../src/admin_page.php")
                    }


                    else{
                      $('.login-modal p').html("Errore! Email e password errati");
                    }
                  },
                  error: function(err){
                    $('.login-modal p').html("Errore nel database");
                  }
          });
      }
    }
    else{
      errorLoginAnimatePopup();
    }
  }

  function populatePopupFromData() {
    $('.user-modal p').html(inputElements[$('#popupInput').data('content')].title);
    $('#popupInput').html(inputElements[$('#popupInput').data('content')].input);
    //se ha già salvata in userInput un campo allora risetta l'input con quel campo
    if(userInfo[inputElements[$('#popupInput').data('content')].info]){
      $('input').val(userInfo[inputElements[$('#popupInput').data('content')].info]);
    }
  }

  function populateLoginPopupFromData() {
    $('.login-modal p').html(loginElements[$('#loginPopupInput').data('content')].title);
    $('#loginPopupInput').html(loginElements[$('#loginPopupInput').data('content')].input);
    //se ha già salvata in userInput un campo allora risetta l'input con quel campo
    if(loginInfo[loginElements[$('#loginPopupInput').data('content')].info]){
      $('input').val(loginInfo[loginElements[$('#loginPopupInput').data('content')].info]);
    }
  }

  function showModal() {
    $('.user-modal').css('opacity', '1').css('visibility', 'visible');
  }

  function showLoginModal() {
    $('.login-modal').css('opacity', '1').css('visibility', 'visible');
  }

  function hideModal() {
    $('.user-modal').css('opacity', '0').css('visibility', 'hidden');
  }

  function hideLoginModal() {
    $('.login-modal').css('opacity', '0').css('visibility', 'hidden');
  }

});
