<?php

include_once "../plantillas/conexxion.php";

include_once "../plantillas/ControlSesion.inc.php";
include_once "../plantillas/declaracionad.php";


                if (ControlSesion::sesion_iniciada()) {
                   ?>
					<nav class="navbar navbar-default navbar-static-top">
                        <div class="navbar-header">
                       		 <a class="navbar-brand" href="#">Registo de estudiantes </a>
                    	</div>
                         <div class="nav navbar-nav navbar-right">
                        <a href="#" class="navbar-brand">
                            <?php echo  $_SESSION['nombre_usuario']; ?>
                        </a>

                        </div>
                        
                    </nav>

				<table class='table table-dark'>
					<thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Nombre</th>
                                <th scope='col'>Contraseña</th>
                                <th scope='col'>rude</th>
                                </tr>
                        </thead>
			<?php			
				if( $rs = mysqli_query($cnn, "SELECT * FROM alumno")) {				
				
					echo "<b>Hay ", mysqli_num_rows($rs), " usuarios registrados:</b>\n";
					
					$cont=0;
					while( $row = mysqli_fetch_array($rs) ){				
						echo "<tr class='row", $cont%2, "'>";
						echo "<td style='width=100px;'>",$row['clave_alumno'], "</td>";
						echo "<td style='width=500px;'>",$row['nombre_alumno'], "</td>";
						echo "<td style='width=100px;'>",$row['contrasena_alumno'], "</td>";
						echo "<td style='width=100px;'>",$row['rude'], "</td>";
						echo "<td style='width=100px;'><button>eliminar</button></td>";
						echo "</tr>\n";
						$cont++;
					}		
					
					//libera la memoria 
					mysqli_free_result($rs);
				}else{
					die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
				}
			?>		
			</table>
			<div class="col-md-6" >
				<div class="panel-body">
					<form role="form" method="post">
                        	<h2>Introduce nuevos datos</h2>
                        <br>
                        <label for="usuario" class="sr-only">clave alumno</label>
                        <input type="text" name="clave_usuario" id="clave_usuario" class="form-control" placeholder="clave" >
                        <br>
                        <label for="usuario" class="sr-only">nombre alumno</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="nombre" >
                        <br>
                        <label for="clave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <button type="submit" name="añadir" class="btn btn-lg btn-primary btn-block">
                            Añadir
                        </button>

                        <?php
                        	if (isset($_POST['añadir'])) {
                        		$num=mysqli_query($cnn,"SELECT max(clave_alumno) as mayor from alumno");
                                    $row = mysqli_fetch_array($num);
                                    $munm=$row['mayor']+1;
                        		$sql="INSERT INTO alumno (clave_alumno, nombre_alumno, contrasena_alumno,rude) VALUES ('".$munm."','".$_POST['nombre_usuario']."','".$_POST['clave']."','".$_POST['clave_usuario']."')";
								if( $rs = mysqli_query($cnn, $sql)) {				
							 		echo "lo lograste ";
							 		echo "<td style='width=100px;'>",$row['nombre_usuario'], "</td>";
								}
								else{
									echo "No se pudo agregar alumno";
								}
								header('Location: AdmAlumnos.php');
                        	}


                        ?>
					</form>
				</div>
			</div>
			<?php

                } else {
                    ?>
                    <li>
                        <a href="#">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            no secion 
                        </a>
                    </li>
                    <?php
                }
                ?>

<?php

include_once "../plantillas/cierread.php"

?>
