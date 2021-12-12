<!DOCTYPE html>
<html>
    <head>
        <title>Gestion Rutas</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../../bootstrap 5/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../bootstrap 5/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../bootstrap 5/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap Jscript -->
        <script src="../../bootstrap 5/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../../bootstrap 5/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="../lib/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <link href="../lib/animate.css/animate.min.css" rel="stylesheet" type="text/css"/>    
        <!-- Datatables Jscript -->
        <script src="../lib/dataTableFull/datatables/media/js/jquery.dataTables.js"></script>
        <script src="../lib/dataTableFull/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../lib/dataTableFull/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

        <!-- Datatables CSS -->
        <link href="../lib/dataTableFull/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/dataTableFull/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/dataTableFull/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../lib/dataTableFull/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../lib/dataTableFull/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../lib/dataTableFull/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">    

        <!-- Mensaje de alerta -->
        <script src="../lib/sweetAlert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
        <link href="../lib/sweetAlert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>

        <!-- Script propios del proyecto -->
        <script src="../JScript/utils.js" type="text/javascript"></script>
        <script src="../JScript/RutasFunciones.js" type="text/javascript"></script>

        <!-- Api Google Maps -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link href="../CSS/MapCSS.css" rel="stylesheet" type="text/css"/>
        <script src="../JScript/MapsJs.js" type="text/javascript"></script>
    </head>

    <body >
        <div>

            <div class="card-body">
                <div class="card-group">
                    <div>
                        <form class="card-body" role="form" onsubmit="return false;" action="../../Backend/Agenda/controller/gestion_rutasController.php">

                            <h5 class="card-title">Ajustes de la Ruta</h5>
                            <br>
                            <p>Fecha Salida: <input type="datetime-local" id="fecha"></p>
                            <br>
                            <p>Fecha Llegada: <input type="text" id="fechaEntrada" readonly="readonly"> 
                                <button type="button" class="btn btn-primary bg-dark" id="Cargar">Cargar</button></p>
                            <br>
                            <p >Duracion: <input type="text" id="duracion" readonly="readonly"/></p>
                            <br>
                            <p>Precio: <input type="text" id="precio" readonly="readonly"></p>
                            <br>
                            <p>Descuento: <input type="text" id="Descuento" style="width: 15%"> %<br>
                                <small class="text-muted">Si no hay un valor no aplica</small></p>


                            <br>
                            <p>Avion: <select name="Avion" id="Avion" style="width: 80%">;

                                    <?php
                                    include "../../Backend/Agenda/dao/connexion.php";
                                    $consulta = " SELECT * FROM gestion_tipoavion";
                                    $ejecutar = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                                    ?>
                                    <?php foreach ($ejecutar as $opciones): ?>

                                        <option value="<?php echo $opciones['PK_tipoAvion'] ?>"><?php echo $opciones['PK_tipoAvion'] ?></option>
                                    <?php endforeach ?>
                                </select></p>
                            <br>
                            <input type="hidden" id="IdRuta" value="0" />
                            <input type="hidden" id="typeAction" value="add_gestion_rutas" />
                            <button type="submit" class="btn btn-primary bg-dark" id="guardar">Guardar</button>
                            <button type="reset" class="btn bg-light" id="cancelar">Cancelar</button>

                            <br><br><br>
                        </form>
                    </div>

                    <div class="card-body ">
                        <div style="display: none">
                            <input id="origin-input" class="controls" type="text" placeholder="Enter an origin location"/>

                            <input id="destination-input" class="controls" type="text" placeholder="Enter a destination location"/>

                        </div>

                        <div id="map" style=" height: 80%; width: 80%;"></div>

                        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
                        <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKSCKxpNo7lWmRv6qKQhe7MhIKS9xjQMw&callback=initMap&libraries=places&v=weekly"
                            async
                        ></script>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="col-md-12">
                    <h5 class="card-title">Lista de Rutas</h5>
                    <table id="dt_GestionRutas"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ruta</th>
                                <th>Duracion</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </body>
</html>

