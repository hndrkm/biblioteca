<?php  
$cnn = mysqli_connect("localhost", "root", "", "BibliotecaVirtual");
	if (mysqli_connect_errno())
		die("<br><br>ERROR: No se logro la conexion a la base de datos...<br><br><br>" . mysqli_connect_error());

?>