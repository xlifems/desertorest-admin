<div class="col-md-12">
	<div class="page-header">
    	<h2>Registrar Fallas</h2>
 	</div>
	<form id="form_faltas">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Estudiante</label>
				<select  name="usuario_id" id="usuario_id"  class="form-control" required="" >
					<option value="1">Motivo 1</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Motivo</label>
				<select name="falta_motivo" id="falta_motivo" class="form-control" required="" >
					<option value="1">Motivo 1</option>
					<option value="2">Motivo 2</option>
					<option value="3">Motivo 3</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Observación</label>
				<input type="text" name="falta_observacion" id="falta_observacion" class="form-control" required="">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			<label>Fecha</label>
			<input type="date" name="falta_fecha1" id="falta_fecha1" class="form-control" required="">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			<label>Fecha</label>
			<input type="date" name="falta_fecha2" id="falta_fecha2" class="form-control" required="">
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-default">Registrar</button>
	<a class="btn btn-default">Cancelar</a>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function (){
	cargarDatosUsuario();
});

function cargarDatosUsuario() {
	$.getJSON("ajax/ajax_actions.php", {accion: 'cargar_clientes' }, function( data ){
		var items = [];
		$.each( data.data, function( key, val ) {
	   		items.push( "<option value='" + val.usuario_id+ "'>" + val.usuario_nombres+" "+val.usuario_apellidos + "</option>" );
		});
		$("#usuario_id").html(items);
	});
}
</script>
