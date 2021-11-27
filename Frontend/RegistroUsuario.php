<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../bootstrap 5/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="../bootstrap 5/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../bootstrap 5/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap Jscript -->
        <script src="../bootstrap 5/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../bootstrap 5/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="lib/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <link href="lib/animate.css/animate.min.css" rel="stylesheet" type="text/css"/>    

        <!-- Datatables Jscript -->
        <script src="lib/dataTableFull/datatables/media/js/jquery.dataTables.js"></script>
        <script src="lib/dataTableFull/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="lib/dataTableFull/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        
        <!-- Datatables CSS -->
        <link href="lib/dataTableFull/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="lib/dataTableFull/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/dataTableFull/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="lib/dataTableFull/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="lib/dataTableFull/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="lib/dataTableFull/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">    

        <!-- Mensaje de alerta -->
        <script src="lib/sweetAlert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
        <link href="lib/sweetAlert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>

        <!-- Script propios del proyecto -->
        <script src="JScript/utils.js" type="text/javascript"></script>
        <script type="text/javascript" src="JScript/Personasfunciones.js"></script>


    </head>
    <body>
        <!-- Modal del BootsTrap para mostrar mensajes-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalTitle">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="myModalMessage">
                        <p>This is a small modal.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de Modal del BootsTrap para mostrar mensajes-->

        <div class="bg-dark">    
            <div class="row justify-content-center">
                <div class="col-xl-10">

                    <h3 class="text-white mb-3"><br>Registro de Usuario</h3>
                    <div class="card border-dark border-5">
                        
                        <form role="form" onsubmit="return false;" id="formPersonas" action="../Backend/Agenda/controller/PersonasController.php">
                            <div class="card-body">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Cedula</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupPK_cedula">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtPK_cedula" />
                                    </div>
                                </div>

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Nombre Completo</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupnombre">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtnombre"/>
                                    </div>
                                </div>  

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Primer Apellido</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupapellido1">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtapellido1" />
                                    </div>
                                </div>  

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Segundo Apellido</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupapellido2">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtapellido2" />
                                    </div>
                                </div>  

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Fecha de Nacimiento</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupfecNacimiento">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtfecNacimiento"/>
                                    </div>
                                </div>  

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Sexo</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupsexo">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtsexo" />

                                    </div>
                                </div>

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Tipo de Usuario</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="grouptipoUsuario">
                                        <input type="text" class="form-control form-control-lg" id="txttipoUsuario" placeholder="Digite 0 para cliente, 1 para administrador"/>

                                    </div>
                                </div>          
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Nombre de Usuario</h6>
                                    </div>
                                    <div class="col-md-4 pe-4" id="groupnombreUsuario">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtnombreUsuario"/>
                                    </div>
                                </div> 
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Contraseña</h6>
                                    </div>
                                    <div class="col-md-5 pe-6" id="groupcontrasena">
                                        <input type="password" name="pass" id="txtcontrasena" placeholder="Utilice una contraseña fuerte" class="form-control form-control-lg border-dark"/> 
                                    </div>
                                </div>  
                                
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Correo Electrónico</h6>
                                    </div>
                                    <div class="col-md-9 pe-5" id="groupcorreo">
                                        <input type="email" class="form-control form-control-lg border-dark" id="txtcorreo" placeholder="example@example.com" />
                                    </div>
                                </div>
                                
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Teléfono Celular</h6>
                                    </div>
                                    <div class="col-md-9 pe-5" id="groupcelular">
                                        <input type="text" class="form-control form-control-lg border-dark" id="txtcelular" placeholder="Digite únicamente los 8 dígitos de su teléfono celular." />
                                    </div>
                                </div>
                                
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Dirección exacta de vivienda</h6>
                                    </div>
                                    <div class="col-md-9 pe-5" id="groupobservaciones">
                                        <input type="text" class="form-control border-dark" rows="3" id="txtdireccion" placeholder="Escriba aquí su dirección.">
                                    </div>
                                    
                                </div>
                                <div class="px-5 py-4">
                                    <input type="hidden" id="typeAction" value="add_personas" />
                                    <button type="submit" class="btn btn-primary bg-dark btn-lg" id="guardar" style="background-color: #198754" >Guardar</button>
                                    <button type="reset" class="btn btn-lg bg-light" id="cancelar" style="background-color: red" >Cancelar</button>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        
                        <div class="card-body">
                            <div class="col-md-12">
                                <table id="dt_personas"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="99%">
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Apellido1</th>
                                            <th>Apellido2</th>
                                            <th>Fec. Nacimiento</th>
                                            <th>Sexo</th>
                                            <th>Celular</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
