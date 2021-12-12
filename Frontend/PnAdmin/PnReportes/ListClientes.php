<!DOCTYPE html>
<html>
    <head>
        <title>Clientes por Avion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../../../bootstrap 5/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../../bootstrap 5/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../../bootstrap 5/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap Jscript -->
        <script src="../../../bootstrap 5/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../../../bootstrap 5/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="../../lib/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <link href="../../lib/animate.css/animate.min.css" rel="stylesheet" type="text/css"/> 
        <!-- Datatables Jscript -->
        <script src="../../lib/dataTableFull/datatables/media/js/jquery.dataTables.js"></script>
        <script src="../../lib/dataTableFull/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../../lib/dataTableFull/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

        <!-- Datatables CSS -->
        <link href="../../lib/dataTableFull/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/dataTableFull/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/dataTableFull/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../../lib/dataTableFull/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../../lib/dataTableFull/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../../lib/dataTableFull/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">    

        <!-- Mensaje de alerta -->
        <script src="../../lib/sweetAlert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
        <link href="../../lib/sweetAlert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>

        <!-- Scripts propios -->
        <script src="../../JScript/utils.js" type="text/javascript"></script>
        <script src="../../JScript/ListaClientes.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="card-body">
            <div class="col-md-12">
                <h5 class="card-title">Lista de Clientes por Avion</h5>
                <table id="dt_ListaClientes"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>ID del Avion</th>
                        </tr>
                        
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>