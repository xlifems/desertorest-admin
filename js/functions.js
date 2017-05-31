$(document).ready(function (){

 $("#form_usuario").submit(function(e) {
	e.preventDefault();
  var opc = "";
	var data = $(this).serializeArray();
  var tipo_usuario = $('#usuario_tipo').val();
  if (tipo_usuario === "est"){
    opc ="registrar_usuario";
  }else {
    opc ="registrar_docente";
  }
	$.post("ajax/ajax_actions.php", {data, accion : opc }, function(resp){
    if (resp > 0) {
      swal("Ok!", "Registro agregado satisfactoriamente", "success");
      console.log(data);
    }
	});
 });

 $("#form_usuario_update").submit(function(e) {
	e.preventDefault();
	var data = $(this).serializeArray();
	$.post("ajax/ajax_actions.php", {data, accion: "modificar_usuario", usuario_id :$('#usuario_id').val()}, function(resp){
    if (resp > 0) {
      swal("Ok!", "Registro modificado satisfactoriamente", "success");
      $('#tbody-usuarios').html("");
      cargarUsuarios();
      $('#row-lista').css('display','block');
      $('#row-modificar').fadeOut();
    }
	});
 });

 $("#form_faltas").submit(function(e) {
 e.preventDefault();
 var data = $(this).serializeArray();
 $.post("ajax/ajax_actions.php", {data, accion: "registrar_faltas"}, function(resp){
    if (resp > 0) {
      swal("Ok!", "Registro agregado satisfactoriamente", "success");
      console.log(data);
    }
 });
 });


$.getJSON("ajax/ajax_actions.php", {accion: 'cargar_clientes' }, function( data ){
	var items = [];
	$.each( data, function( key, val ) {
   		items.push( "<option value='" + val.usuario_id+ "'>" + val.usuario_nombres+" "+val.usuario_apellidos + "</option>" );
	});
	$("#ins_persona_id").html(items);
});

$.getJSON("js/departamentos.json", function (data){
	 var items = [];
	 $.each( data, function( key, val ) {
	    items.push( "<option value='" + val.id + "'>" + val.value + "</option>" );
	 });
	 $("#usuario_departamento").html(items);
});

$("#usuario_departamento").on("change", function(){
	 	var id = $(this).val();
	 	$.getJSON("ajax/ajax_actions.php", {id:id, accion: 'cargar_municipios' }, function( data ){
	 		var items = [];
	 		$.each( data, function( key, val ) {
			   items.push( "<option value='" + val.id_municipio+ "'>" + val.descripcion + "</option>" );
			});
			$("#usuario_ciudad").html(items);
	 	});
});


});
