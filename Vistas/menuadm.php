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
                        <a class="navbar-brand" href="#">Bienvenid@ </a>
                    </div>
                         <div class="nav navbar-nav navbar-right">
                        <a href="#" class="navbar-brand">
                            <?php echo  $_SESSION['nombre_usuario']; ?>
                        </a>

                        </div>
                        
                    </nav>
                    <div class="card text-center" style="width: 80rem;">
                        <div class="card-body">
                            <h2 class="card-title">Estudiantes</h4>
                            <p class="card-text">Sitio para gestion de estudiantes con ingreso a la biblioteca</p>
                            <a href="AdmAlumnos.php" class="btn btn-primary btn-lg active" role="button">
                            Alumnos
                            </a>
                        </div>
                    </div>
                        
                    <div class="card text-center" style="width: 80rem;>
                        <div class="card-body">
                            <h2 class="card-title">Libros</h4>
                            <p class="card-text">Sitio para gestion de Libros de la biblioteca</p>
                            <a href="AdmLibros.php" class="btn btn-primary btn-lg active" role="button">
                            Libros
                        </a>
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
