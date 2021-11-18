<?php

require_once ("../../utlis/adodb5/adodb.inc.php");
require_once ("../domain/gestion_rutas.php");




class gestion_rutasDao{
    
    private $labAdodb;
    
    public function __construct() {
        $driver = 'mysqli';
        $this->labAdodb = newAdoConnection($driver);
        //$this->labAdodb->setCharset('utf8');
        //$this->labAdodb->setConnectionParameter('CharacterSet', 'WE8ISO8859P15');
        $this->labAdodb->Connect("localhost", "root2", "root2", "mydb");
        $this->labAdodb->debug=true;
    }
    
    //***********************************************************
    //agrega a una ruta a la base de datos
    //***********************************************************
    
    
    public function add(GestionRutas $gestion_ruta){ 
        
        try {
            
            $sql = sprintf("insert into gestionVuelo(idgestion_rutas,dia_semana_hora,ruta,duracion,lastUser,lastModification,FK_idgestion_tipoavion, FK_idgestion_rutas)
                                        values (%s,%s,%s,%s,%s,CURDATE())",
                    
                    $this->labAdodb->Param("idgestion_rutas"),
                    $this->labAdodb->Param("dia_semana_hora"),
                    $this->labAdodb->Param("ruta"),
                    $this->labAdodb->Param("duracion"),
                    $this->labAdodb->Param("LASTUSER"));
                    
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_rutas"]                  =  $gestion_ruta->getidgestion_rutas();
            $valores["dia_semana_hora"]                  =  $gestion_ruta->getdia_semana_hora();
            $valores["ruta"]                             =  $gestion_ruta->getruta();
            $valores["duracion"]                         =  $gestion_ruta->getduracion();   
            $valores["LASTUSER"]                         =  $gestion_ruta->getLastUser();
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase gestion_rutasDao), error:'.$e->getMessage());
        }
    }
    
    //***********************************************************
    //verifica si una ruta existe en la base de datos por ID
    //***********************************************************
    
    public function exist(GestionRutas $gestion_rutas) {

        
        $exist = false;
        try {
            $sql = sprintf("select * from gestion_rutas where idgestion_rutas = %s ",
                            $this->labAdodb->Param("idgestion_rutas"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idgestion_rutas"] = $gestion_rutas->getidgestion_rutas();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase gestionVueloDao), error:'.$e->getMessage());
        }
    }
    
    
    //***********************************************************
    //Modifica una gestion de vuelo en la base de datos
    //***********************************************************

    public function update(GestionVuelo $gestionVuelo) {

        
        try {
            $sql = sprintf("update gestionVuelo set Fecha = %s, 
                                                Precio = %s,   
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 
                                                FK_idgestion_tipoavion = %s,
                                                FK_idgestion_rutas = %s,

                            where idgestionVuelo = %s",
                    $this->labAdodb->Param("Fecha"),
                    $this->labAdodb->Param("Precio"),
                    $this->labAdodb->Param("LASTUSER"),
                    $this->labAdodb->Param("FK_idgestion_tipoavion"),
                    $this->labAdodb->Param("FK_idgestion_rutas"));
            
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["Fecha"]                                 = $gestionVuelo->getnomLugar();
            $valores["Precio"]                                = $gestionVuelo->getdireccion();
            $valores["LASTUSER"]                              = $gestionVuelo->getLastUser();
            $valores["FK_idgestion_tipoavion"]                = $gestionVuelo->getFK_idgestion_tipoavion();
            $valores["FK_idgestion_rutas"]                    = $gestionVuelo->getFK_idgestion_rutas();
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase gestionVueloDao), error:'.$e->getMessage());
        }
    }
    
    
    //***********************************************************
    //elimina una gestion de avión en la base de datos
    //***********************************************************
    
    
     public function delete(GestionVuelo $gestionVuelo) {

        
        try {
            $sql = sprintf("delete from gestionVuelo where idgestion_Vuelo = %s",
                            $this->labAdodb->Param("idgestion_Vuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_Vuelo"] = $gestionVuelo->getidgestion_Vuelo();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase gestionVueloDao), error:'.$e->getMessage());
        }
    }

    
    //***********************************************************
    //busca una gestion de vuelo en la base de datos
    //***********************************************************

    public function searchById(GestionVuelo $gestionVuelo) {

        
        $returngestionVuelo = null;
        try {
            $sql = sprintf("select * from gestionVuelo where idgestionVuelo = %s",
                            $this->labAdodb->Param("idgestionVuelo"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestionVuelo"] = $gestionVuelo->getidgestionVuelo();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returngestionVuelo = GestionVuelo::createNullGestionVuelo();
                $returngestionVuelo->setidgestionVuelo($resultSql->Fields("idgestionVuelo"));
                $returngestionVuelo->setFecha($resultSql->Fields("Fecha"));
                $returngestionVuelo->setPrecio($resultSql->Fields("Precio"));
                $returngestionVuelo->setFK_idgestion_tipoavion($resultSql->Fields("FK_idgestion_tipoavion"));
                $returngestionVuelo->setFK_idgestion_rutas($resultSql->Fields("FK_idgestion_tipoavion"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase gestionVueloDao), error:'.$e->getMessage());
        }
        return $returnDirecciones;
    }
    
    //***********************************************************
    //obtiene la información de las gestiones de vuelo en la base de datos
    //***********************************************************
    
    public function getAll() {

        
        try {
            $sql = sprintf("select * from gestionVuelo");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase gestionVueloDao), error:'.$e->getMessage());
        }
    }
    
    
}