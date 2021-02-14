$(document).ready(function() {
  $.ajax({
    url: "../controller/get_admin_info.php",
    type: "POST",
    success: function(response){
      var json = JSON.parse(response);
      $('.email').append(json[0].email);
      $('.phone').append(json[0].telefono);
    }
  });
});
