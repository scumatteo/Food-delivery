$(document).ready(function() {
  email = "";
  var seller = [];
  cart = [];
  var isOpen = false;
  var mobile = false;
  takeSeller();
  updateCart();
  $('.closebtn').on('click', function() {
    closeCart();
  });

  function checkPosition() {
    if (window.matchMedia('(max-width: 576px)').matches) {
      mobile = true;
    }else{
      mobile = false;
    }
  }

  $("#cartButton").click(function() {
    toogleCart();
  });

  function updateCart(){
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
      }
    });
  }

  function toogleCart(){
    checkPosition();
    if(isOpen){
      closeCart();
      isOpen = false;
    }else{
      openCart();
      isOpen = true;
    }
  }


  function openCart() {
    updateCart();
    populateCart();
    if(mobile==false){ //Dekstop
      $("body").css({"position": "absolute", "overflow": "auto", "margin-right" : "30%", "width" : "70%", "transition": "0.5s"});
      document.getElementById("menu-cart").style.width = "30%";
    }else{ //Mobile
      document.getElementById("menu-cart").style.width = "100%";
    }
  }

  function populateCart(){
    document.getElementById("cart-cards").innerHTML = '';
    for (var i=0; i< cart.length; i++){
      var div = document.createElement("div");
      var divbody = document.createElement("div");
      var title = document.createElement("H5");
      var category = document.createElement("p");
      var portions = document.createElement("p");
      var row_1 = document.createElement("div");
      var row_2 = document.createElement("div");
      var price = document.createElement("span");

      div.classList.add("cart-card");
      div.classList.add("container-fluid");

      divbody.classList.add("cart-card-body");
      row_1.classList.add("row");
      row_2.classList.add("row");

      title.classList.add("cart-card-title");
      title.textContent = cart[i].nome;
      price.textContent = cart[i].prezzo_tot + "€";
      price.classList.add("ml-auto");
      category.classList.add("text-muted");
      portions.classList.add("text-muted");
      portions.classList.add("ml-auto");

      row_1.appendChild(title);
      row_1.appendChild(price);

      category.textContent = cart[i].tipo;
      portions.textContent = "x"+cart[i].porzioni;

      row_2.appendChild(category);
      row_2.appendChild(portions);

      divbody.appendChild(row_1);
      divbody.appendChild(row_2);
      div.appendChild(divbody);
      $("#cart-cards").append(div);
    }
  }

  function closeCart() {
    if(mobile==false){
      $("body").css({"position": "auto", "overflow-x": "hidden", "margin-right" : "0", "width" : "100%", "transition": "0.5s"});
    }
    document.getElementById("menu-cart").style.width = "0";
    isOpen = false;
  }



  function takeSeller(){
    $.ajax({
      url: "../controller/seller_for_product.php",
      type: "POST",
      success: function(response){
        if(response.length > 0){
          var json = JSON.parse(response);
          for(var i = 0; i < json.length; i++){
            seller[i] = json[i];
          }
        }

        if(seller.length>0){
          email = seller[0].email;
          console.log(email);
        }


      }

    });
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

  $('#ok-cart').on('click', function() {
    if(cart.length>0){
      window.location.href = ("../src/checkout.php?email="+email);
    }
    else{
      alert("Carrello vuoto!");
    }
  });

});
