<?php

include_once "../plantillas/conexxion.php";

include_once "../plantillas/ControlSesion.inc.php";
include_once "../plantillas/declaracionad.php";

?>
            
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                    
                        <nav class="navbar navbar-default navbar-static-top">
                        <div class="navbar-header">
                             <a class="navbar-brand" href="#">Registo de Libros </a>
                        </div>
                         <div class="nav navbar-nav navbar-right">
                        <a href="#" class="navbar-brand">
                            <?php echo  $_SESSION['nombre_usuario']; ?>
                        </a>

                        </div>
                        
                        </nav>
                    <div class="container" align="center">
                     <div class="col-md-10" >
                      <table class='table table-dark'>
                        <thead>
                                <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>titulo</th>
                                <th scope='col'>categoria</th>
                                <th scope='col'>descripcion</th>
                                <th scope='col'>autor</th>
                                <th scope='col'>direccion</th>
                                </tr>
                        </thead>
					<?php			
					   if( $rs = mysqli_query($cnn, "SELECT * FROM libros")) {				
					       
					       $cont=0;
					       $librosarray;
					       while( $row = mysqli_fetch_array($rs) ){				
						      echo "<td >",$row['clave_libro'], "</td>";
						      echo "<td >",$row['titulo'], "</td>";
						      echo "<td >",$row['categoria'], "</td>";
                              echo "<td >",$row['descripcion'], "</td>";
                              echo "<td >",$row['autor'], "</td>";
						      echo "<td ><a href='../Libros/".$row['ruta']."'>ver</a></td>";	
						      echo "</tr>\n";
						      $cont++;
					       }		
				           mysqli_free_result($rs);
				        }else{
					       die("<br><br>ERROR: No se ejecuto con exito la consulta sql...<br><br><br>" . mysqli_error($cnn));
				        }
			         ?>		
                        </table>
                    </div>
                </div>
                    <div class="container" align="center">
                     <div class="col-md-6" >
                     <form role="form" method="post" action="" enctype="multipart/form-data">    
                        <div class="panel-body">
                            <label for="libros" ><h1>Archivo</h1></label>
                            <br>
                        <label for="usuario" class="">Categoria</label>
                        <input type="text" name="categoria" id="categoria" class="form-control" placeholder="categoria" required>
                        <br>
                        <label for="usuario">Titulo</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="titulo" >
                                    
                        <br>
                        <label for="usuario">Descripcion</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion" >
                                    <br>                  
                        <label for="usuario">Autor</label>
                        <input type="text" name="autor" id="autor" class="form-control" placeholder="autor" >
                        <br>
                        
                        <input  type="file" name="filename" class="btn btn-lg btn-primary btn-block" required>
                        <button type="submit" name="añadir" class="btn btn-lg btn-primary btn-block">
                            añadir
                        </button>
                        </div>

                        <?php
                        if (isset($_POST['añadir'])) {
                            $carpetaDestino="../Libros/";
                            $nombre = $_FILES['filename']['name'];
                            $ruta = $_FILES['filename']['tmp_name'];
                            
                            if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                            {   
                                $origen=$_FILES["filename"]["tmp_name"];
                                $destino=$carpetaDestino.$_FILES["filename"]["name"];
                                # movemos el archivo
                                if(@move_uploaded_file($origen, $destino))
                                {   
                                    $nombre=$_POST['titulo'];
                                    $categoria=$_POST['categoria'];
                                    $descripcion=$_POST['descripcion'];
                                    $autor=$_POST['autor'];
                                    $adm = $_SESSION['id_usuario'];
                                    $ruta =$_FILES['filename']['name'];
                                    $num=mysqli_query($cnn,"SELECT max(clave_libro) as mayor from libros");
                                    $row = mysqli_fetch_array($num);
                                    $munm=$row['mayor']+1;
                                    $sql="INSERT INTO libros (categoria,autor,titulo,descripcion,ruta,codigoadm,clave_libro) VALUES ('".$categoria."','".$autor."','".$nombre."','".$descripcion."','".$ruta."','".$adm."','".$munm."')";
                                    echo $sql;
                                    if( $rs = mysqli_query($cnn, $sql)) {               
                                        echo "lo lograste ";
                                        
                                    }
                                    else{
                                        echo "No se pudo agregar libro";
                                    }


                                    echo "<br>".$_FILES["filename"]["name"]." agregado correctamente";
                                }else{
                                    echo "<br>No se ha podido agregar el archivo: ".$_FILES["filename"]["name"];
                                }
                            }else{
                                echo "<br>No se ha podido crear la carpeta: up/".$user;
                            }
                            header('Location: AdmLibros.php');
                        }
                        ?>
                    </form>
                    </div>
                    </div>
    
                    <?php
                    
                } else {
                    ?>
                           <a href="#">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            no secion 
                        </a>
                    
                    <?php
                }
                ?>
           


<?php

include_once "../plantillas/cierread.php"

?>
