<?php  
include_once "../plantillas/conexxion.php";

include_once "../plantillas/ControlSesion.inc.php";
include_once "../plantillas/declaracionad.php";
?>
<div id="navbar" class="navbar-collapse collapse">
            
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                     <nav class="navbar navbar-default navbar-static-top">
                        <div class="navbar-header">
                             <a class="navbar-brand" href="#">Libros de la biblioteca </a>
                        </div>
                         <div class="nav navbar-nav navbar-right">
                        <a href="#" class="navbar-brand">
                            <?php echo  $_SESSION['nombre_usuario']; ?>
                        </a>

                        </div>
                        
                        </nav>
                    <form role="form" method="post">
                    <table>

					<?php			
					if( $rs = mysqli_query($cnn, "SELECT * FROM libros")) {				
					echo "<tr><td colspan='4'><b>Hay ", mysqli_num_rows($rs), " libros registrados:</b></td></tr>\n";
					echo "<table class='table table-dark'>";
                    echo "<thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>clave Libro</th>
                                <th scope='col'>nombre</th>
                                <th scope='col'>autor</th>
                                <th scope='col'>ver</th>
                                </tr>
                        </thead>
                        <tbody>";
                        $cont=0;

					while( $row = mysqli_fetch_array($rs) ){				
						echo "<tr><th scope='row'>".$cont."</th>";
						echo "<td>",$row['clave_libro'], "</td>";
                        
						echo "<td >",$row['titulo'], "</td>";
						echo "<td >",$row['autor'], "</td>";
						echo "<td ><a href='../Libros/".$row['ruta']."'>ver</a></td>";	
						echo "</tr>\n";
						$cont++;
					}
                    echo "</tbody>
                    </table>";	
					
					mysqli_free_result($rs);
				}else{
					die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
				}
			?>		
			<input type="submit" name="butSubmit" value="Buscar Libro" class="input4">
            <input type="text" name="buscar" size="24" >

                    	<?php
                $editFormAction = $_SERVER['PHP_SELF'];

                if( isset($_POST['buscar']) ){

                $s=mysqli_connect("localhost","root","","bibliotecavirtual");

                $queryPrimeraTabla = mysqli_query($s,"SELECT * from libros where titulo='".$_POST['buscar']."';");

                if( mysqli_num_rows($queryPrimeraTabla) > 0 ){
                    echo "<table class='table table-bordered'>";
                    echo "<thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>clave Libro</th>
                                <th scope='col'>titulo</th>
                                <th scope='col'>autor</th>
                                </tr>
                        </thead>
                        <tbody>";
                        $i=1;
                    while( $resultado = mysqli_fetch_array($queryPrimeraTabla) ){
                        echo "<tr><th scope='row'>".$i."</th>";
                        echo "<td>".$resultado['clave_libro']."</td>";
                        echo "<td>".$resultado['titulo']."</td>";
                        echo "<td>".$resultado['autor']."</td>";
                        echo "<td>".$resultado['ruta']."</td>";
                        echo "</tr>";
                        $i++;
                    }
                    echo "</tbody>
                    </table>";
                }else{ 
                    echo "<p />No se encontro <b>".$_POST['buscar']."</b> en la base de datos.";
                } 
                }
                ?>

                </form>

        </div>
   
                    <?php
                } else {
                    ?>
                    <div class="container" align="center">
                         <h1>No ha iniciado sesion  <span class="badge badge-secondary">...</span></h1>
                            <div class="alert alert-danger" role="alert" align="center">
                             <h4> <a href="../index.php">ingresar</a> </h4> 

                            </div>
                    </div>
                        
                    
                  
                    
                    <?php
                }
                ?>
          
        <?php

include_once "../plantillas/cierread.php"

?>
