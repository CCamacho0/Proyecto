<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registro de Usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style type="text/css">
            /*Styles.css*/
            </style>
            <link type ="text/css" href="CSS/styles.css" rel="stylesheet"/>
            
        <script src="lib/jquery/dist/jquery.min.js" type="text/javascript"></script>
        
        <!-- common css. required for every page-->
        <link href="lib/bootstrap/dist/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="lib/bootstrap/dist/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        
        <link href="lib/animate.css/animate.min.css" rel="stylesheet" type="text/css"/>    
            
        <!-- Page scripts -->
        <!-- Datatables -->
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
        <script type="text/javascript" src="JScript/Persibasfunciones.js"></script>
        
        
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
        
        <section class="vh-100" style="background-color:#51585e ;">
  <div class="container h-100">
    <div class="row d-flex justify-content-lg-center align-items-center h-100">
      <div class="col-xl-9">

          <h1 class="text-white mb-2">Registro de Usuario</h1>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Cedula</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>
              
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Nombre Completo</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>  
              
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Primer Apellido</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>  
            
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Segundo Apellido</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>  
            
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Fecha de Nacimiento</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>  
            
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Sexo</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>
              
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Nombre de Usuario</h6>

              </div>
              <div class="col-md-4 pe-4">

                <input type="text" class="form-control form-control-lg" />

              </div>
            </div>  
            
            <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Contraseña</h6>

              </div>
              <div class="col-md-5 pe-6">

                  <input type="password" name="pass" placeholder="Utilice una contraseña fuerte" class="form-control form-control-lg"/> 

              </div>
            </div>  

            

            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Correo Electrónico</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="email" class="form-control form-control-lg" placeholder="example@example.com" />

              </div>
            </div>

            

            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Teléfono Celular</h6>

              </div>
              <div class="col-md-9 pe-5">

                <input type="email" class="form-control form-control-lg" placeholder="Digite únicamente los 8 dígitos de su teléfono celular." />
                  
              </div>
            </div>


            <div class="row align-items-center py-3">
              <div class="col-md-3 ps-5">

                <h6 class="mb-0">Dirección exacta de vivienda</h6>

              </div>
              <div class="col-md-9 pe-5">

                <textarea class="form-control" rows="3" placeholder="Escriba aquí su dirección."></textarea>
                    
              </div>
            </div>

            <div class="px-5 py-4">
                <input type="hidden" id="typeAction" value="add_personas" />
                <button type="submit" class="btn btn-primary btn-lg" id="guardar" style="background-color: #198754" >Guardar</button>
                <button type="reset" class="btn btn-primary btn-lg" id="cancelar" style="background-color: red" >Cancelar</button>
            </div>
              
          </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table id="dt_personas"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
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

            <br><br><br><br>
        </div>

      </div>
    </div>
  </div>//<!---Contenido de RegistroUsuario--->
</section>
        
    </body>
</html>
