$(document).ready(function (){
  /**
  * [description]
  * @param  {[type]} ){                                                     var usuario [description]
  * @param  {[type]} cache: false              }).done(function(resp){                               if(resp [description]
  * @return {[type]}        [description]
  */
  $("#ingresar").click(function (){
    var usuario = $("#usuario").val();
    var password = $("#password").val();
    if (usuario == '' || password == ''){
      console.log("error");
    } else {
      $.ajax({
        url: "ajax/ajax_actions.php",
        type: "POST",
        data: {usuario: usuario, password: password, accion: "login_user"},
        cache: false
      }).done(function(resp){
        var data = resp;
        if(data.docentes_id > 0){
          window.location.href = "home.php";
        } else {
          sweetAlert("Oops... ", "Usuarios o contraseña incorrecto!", "error");
        }
      })
    }
  });

  //Login mediante enter
  $('#password').keypress(function(e) {
    if(e.which == 13) {
      var usuario = $("#usuario").val();
      var password = $("#password").val();
      if (usuario == '' || password == ''){
        console.log("error");
      } else {
        $.ajax({
          url: "ajax/ajax_actions.php",
          type: "POST",
          data: {usuario: usuario, password: password, accion: "login_user"},
          cache: false
        }).done(function(resp){
          if(resp == 1){
            window.location.href = "home.php";
          } else {
            sweetAlert("Oops... ", "Usuarios o contraseña incorrecto!", "error");
          }
        })
      }
    }
  });

});

function guardar_progreso( nivel_id, usuario_id) {
  var data = {
    'accion' : 'guardar_progreso',
    'nivel_id' : nivel_id,
    'usuario_id' : usuario_id
  }
  $.ajax({
    url : 'ajax/ajax_actions.php',
    type : 'POST',
    data : data,
    success : function(respuesta) {
      swal("Lección completada!", "Conocemos un poco de animales", "success");
    }
  });
}
