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

        <!-- Mensaje de alerta -->
        <script src="../lib/sweetAlert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
        <link href="../lib/sweetAlert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>

        <!-- Script propios del proyecto -->
        <script src="../JScript/utils.js" type="text/javascript"></script>
        <script src="../JScript/Personasfunciones.js" type="text/javascript"></script>

        <!-- Api Google Maps -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link href="../CSS/MapCSS.css" rel="stylesheet" type="text/css"/>
        <script src="../JScript/MapDireccion.js" type="text/javascript"></script>
    </head>

    <body >
        <div>
            <div class="card-body">
                <h3>Registro de Usuario</h3>
                <br>
                <div class="card-group">
                    <div>
                        <form class="card-body" role="form" onsubmit="return false;" action="../../Backend/Agenda/controller/PersonasController.php">
                            <p class="card-title">Cedula: <input type="text" id="txtPK_cedula" /></p>
                            <br>
                            <p class="card-title">Nombre completo: <input type="text" id="txtnombre" /></p>
                            <br>
                            <p class="card-title">Primer Apellido: <input type="text" id="txtapellido1" /></p>
                            <br>
                            <p class="card-title">Segundo Apellido: <input type="text" id="txtapellido2" /></p>
                            <br>
                            <p>Fecha Nacimiento: <input type="date" id="txtfecNacimiento"></p>
                            <br>
                            <p class="card-title">Sexo: 
                                <select id="txtsexo" style=" size: 80%">
                                    <option selected disabled hidden value=''></option>
                                    <option value="1">Masculino</option>
                                    <option value="0">Femenino</option>
                                </select>
                            </p>
                            <br>
                            <p class="card-title">Nommbre Usuario: <input type="text" id="txtnombreUsuario" /></p>
                            <br>
                            <p class="card-title">Contraseña: <input type="password" id="txtcontrasena" /></p>
                            <br>
                            <p class="card-title">Correo: <input type="email" id="txtcorreo" placeholder="example@example.com" /></p>
                            <br>
                            <p class="card-title">Celular: <input type="text" id="txtcelular" /></p>
                            <br>
                            
                            <input type="hidden" id="txttipoUsuario" value="0" />
                            <input type="hidden" id="typeAction" value="add_personas" />
                            <button type="submit" class="btn btn-primary bg-dark" id="guardar">Guardar</button>
                            <button type="reset" class="btn bg-light" id="cancelar">Cancelar</button>
                        </form>
                    </div>

                    <div class="card-body ">
                        <p class="card-title" style="margin-left: 100px">Busque su direccion: </p>
                        <div style="display: none">
                            <input id="pac-input" class="controls" type="text" placeholder="Enter a location"/>
                        </div>
                        <div id="map" style="height: 450px"></div>
                        <div id="infowindow-content">
                            <span id="place-name" class="title"></span><br />
                            <strong></strong> <span id="place-id"></span><br />
                            <span id="place-address"></span>
                        </div>

                        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
                        <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKSCKxpNo7lWmRv6qKQhe7MhIKS9xjQMw&callback=initMap&libraries=places&v=weekly"
                            async
                        ></script>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
