<?php session_start();?>
<p><B>Usuario:</B> <?php echo $_SESSION["nombres"]?></p>
<div class="row titulos">
	<h1>CATEGORÍAS</h1>
</div>
<div class="row inicio">
	<div class="col-sm-4" >
		<a href="?page=animals"><img src="img/categoria/animals.png" ></a>
	</div>
	<div class="col-sm-4" >
		<a href="?page=vocales"><img src="img/categoria/letters.png" ></a>
	</div>
	<div class="col-sm-4" >
		<a href="?page=numeros"><img src="img/categoria/numbers.png" ></a>
	</div>
</div>
