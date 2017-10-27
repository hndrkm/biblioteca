<?php

include_once "plantillas/declaracion.php"

?>
<nav class="navbar navbar-default navbar-static-top">
	<div class="navbar-header">
             <a class="navbar-brand" href="#">Bienvenido a la biblioteca</a>
        </div>
         <div id="navbar" class="nav navbar-nav navbar-right">
         	 <ul class="nav navbar-nav">
				     
						<li><form role="form" name="Inicio" action=""  method="post"> 
						<input type="submit" name="btnadm" value="Sesion Administrador" class="navbar-brand">
						<input type="submit" name="btnalum" value="Sesion Alumno" class="navbar-brand">
						</form></li>
				    </ul>
         </div>
</nav>
<div align="center">

<figure class="figure">
  <img src="img/buho.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
  <figcaption class="figure-caption">aqui va la frase</figcaption>

</figure>
</div>
<?php	
if( isset($_POST['btnadm']) ){
	header('Location: administrador.php');
}else{
if( isset($_POST['btnalum']) ){
	header('Location: alumno.php');
     }
}
include_once "plantillas/cierre.php"
?>