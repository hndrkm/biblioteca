<?php
include_once "plantillas/conexxion.php";

include_once "plantillas/ControlSesion.inc.php";
include_once "plantillas/declaracion.php"

?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>Iniciar sesión</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        	<h2>Introduce tus datos</h2>
                        <br>
                        <label for="usuario" class="sr-only">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="usuario" >
                        <br>
                        <label for="clave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                            Iniciar sesión
                        </button>
                        <?php 
                        if( isset($_POST['login']) ){
							$sql = "SELECT * FROM administrador WHERE nombre_admin='" .  $_POST['usuario'] . "' and contrasena_admin='" .  $_POST['clave'] . "'";
							echo $sql;
							if( $rs = mysqli_query($cnn, $sql)) {				
								echo "son :".mysqli_num_rows($rs);
								if(mysqli_num_rows($rs)){
									$row = mysqli_fetch_array($rs);

							 		echo "lo lograste ";
							 		echo "<td style='width=100px;'>",$row['nombre_admin'], "</td>";
							 		ControlSesion::iniciar_sesion($row['clave_admin'],$row['nombre_admin']);
							header('Location: Vistas/menuadm.php');

								}else{
								echo "<p style='color:red;'><b>NO HAY NINGUN ADMINISTRADOR CON clave_admin='", $_POST['clave_admin'], "' y contrasena_admin='", $_POST['contrasena_admin'],"'</b></p>";
								}

							}else{
								die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
							}
						}

                        ?>
                    </form>
                    <br>
                    <br>
               </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once "plantillas/cierre.php"

?>
