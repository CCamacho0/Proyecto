<?php

require_once ("../../utlis/adodb5/adodb.inc.php");
require_once ("../domain/gestion_tipoavion.php");




class gestion_tipoavionDao{
    
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
    //agrega a un tipo de avion a la base de datos
    //***********************************************************
    
    
    public function add(GestionAvion $gestion_tipoavion){ 
        
        try {
            
            $sql = sprintf("insert into gestion_tipoavion(idgestion_tipoavion,año,modelo,marca,
                cantidad_pasajeros,cantidad_filas, cantidadasientos_fila,lastUser,lastModification)
                                        values (%s,%s,%s,%s,%s,%s,%s,%s,CURDATE())",
                    
                    $this->labAdodb->Param("idgestion_tipoavion"),
                    $this->labAdodb->Param("año"),
                    $this->labAdodb->Param("modelo"),
                    $this->labAdodb->Param("marca"),
                    $this->labAdodb->Param("cantidad_pasajeros"),
                    $this->labAdodb->Param("cantidad_filas"),
                    $this->labAdodb->Param("cantidadasientos_fila"),
                    $this->labAdodb->Param("LASTUSER"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_tipoavion"]              =  $gestion_tipoavion->getidgestion_tipoavion();
            $valores["año"]                              =  $gestion_tipoavion->getaño();
            $valores["modelo"]                           =  $gestion_tipoavion->getmodelo();
            $valores["marca"]                            =  $gestion_tipoavion->getmarca();
            $valores["cantidad_pasajeros"]               =  $gestion_tipoavion->getcantidad_pasajeros();
            $valores["cantidad_filas"]                   =  $gestion_tipoavion->getcantidad_filas();
            $valores["cantidadasientos_fila"]            =  $gestion_tipoavion->getcantidadasientos_fila();
            $valores["LASTUSER"]                         =  $gestion_tipoavion->getLastUser();
            
            
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo insertar el registro (Error generado en el metodo add de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
    }
    
    //***********************************************************
    //verifica si un avion existe en la base de datos por ID
    //***********************************************************
    
    public function exist(GestionTipoAvion $gestion_tipoavion) {

        
        $exist = false;
        try {
            $sql = sprintf("select * from gestion_tipoavion where idgestion_tipoavion= %s ",
                            $this->labAdodb->Param("idgestion_tipoavion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();
            $valores["idgestion_tipoavion"] = $gestion_tipoavion->getidgestion_tipoavion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            if ($resultSql->RecordCount() > 0) {
                $exist = true;
            }
            return $exist;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener el registro (Error generado en el metodo exist de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
    }
    
    
    //***********************************************************
    //Modifica un avion en la base de datos
    //***********************************************************

    public function update(GestionTipoAvion $gestion_tipoavion) {

        
        try {
            $sql = sprintf("update gestion_tipoavion set 
                                                año = %s, 
                                                modelo = %s,
                                                marca = %s,
                                                cantidad_pasajeros = %s,
                                                cantidad_filas = %s,
                                                cantidadasientos_fila = %s, 
                                                LASTUSER = %s, 
                                                LASTMODIFICATION = CURDATE() 

                            where idgestion_tipoavion = %s",
                    $this->labAdodb->Param("año"),
                    $this->labAdodb->Param("modelo"),
                    $this->labAdodb->Param("marca"),
                    $this->labAdodb->Param("cantidad_pasajeros"),
                    $this->labAdodb->Param("cantidad_filas"),
                    $this->labAdodb->Param("cantidadasientos_fila"),
                    $this->labAdodb->Param("LASTUSER"));
                    
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["año"]                              = $gestion_tipoavion->getaño();
            $valores["modelo"]                           = $gestion_tipoavion->getmodelo();
            $valores["marca"]                            = $gestion_tipoavion->getmarca();
            $valores["cantidad_pasajeros"]               = $gestion_tipoavion->getcantidad_pasajeros();
            $valores["cantidad_filas"]                   = $gestion_tipoavion->getcantidad_filas();
            $valores["cantidadasientos_fila"]            = $gestion_tipoavion->getcantidadasientos_fila();
            $valores["LASTUSER"]                         = $gestion_tipoavion->getLastUser();
            
            
            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el registro (Error generado en el metodo update de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
    }
    
    
    //***********************************************************
    //elimina una gestion de avión en la base de datos
    //***********************************************************
    
    
     public function delete(GestionTipoAvion $gestion_tipoavion) {

        
        try {
            $sql = sprintf("delete from gestion_tipoavion where idgestion_tipoavion = %s",
                            $this->labAdodb->Param("idgestion_tipoavion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_tipoavion"] = $gestion_tipoavion->getidgestion_tipoavion();

            $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
        } catch (Exception $e) {
            throw new Exception('No se pudo eliminar el registro (Error generado en el metodo delete de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
    }

    
    //***********************************************************
    //busca una gestion de avión en la base de datos
    //***********************************************************

    public function searchById(GestionTipoAvion $gestion_tipoavion) {

        
        $returngestion_tipoavion = null;
        try {
            $sql = sprintf("select * from gestion_tipoavion where idgestion_tipoavion = %s",
                            $this->labAdodb->Param("idgestion_tipoavion"));
            $sqlParam = $this->labAdodb->Prepare($sql);

            $valores = array();

            $valores["idgestion_tipoavion"] = $gestion_tipoavion->getidgestion_tipoavion();

            $resultSql = $this->labAdodb->Execute($sqlParam, $valores) or die($this->labAdodb->ErrorMsg());
            
            if ($resultSql->RecordCount() > 0) {
                $returngestion_tipoavion = GestionTipoAvion::createNullGestionTipoAvion();
                $returngestion_tipoavion->setidgestion_tipoavion($resultSql->Fields("idgestion_tipoavion"));
                $returngestion_tipoavion->setaño($resultSql->Fields("año"));
                $returngestion_tipoavion->setmodelo($resultSql->Fields("modelo"));
                $returngestion_tipoavion->setmarca($resultSql->Fields("marca"));
                $returngestion_tipoavion->setcantidad_pasajeros($resultSql->Fields("cantidad_pasajeros"));
                $returngestion_tipoavion->setcantidad_filas($resultSql->Fields("cantidad_filas"));
                $returngestion_tipoavion->setcantidadasientos_fila($resultSql->Fields("cantidadasientos_fila"));
            }
        } catch (Exception $e) {
            throw new Exception('No se pudo consultar el registro (Error generado en el metodo searchById de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
        return $returnDirecciones;
    }
    
    //***********************************************************
    //obtiene la información de los aviones en la base de datos
    //***********************************************************
    
    public function getAll() {

        
        try {
            $sql = sprintf("select * from gestion_tipoavion");
            $resultSql = $this->labAdodb->Execute($sql);
            return $resultSql;
        } catch (Exception $e) {
            throw new Exception('No se pudo obtener los registros (Error generado en el metodo getAll de la clase gestion_tipoavionDao), error:'.$e->getMessage());
        }
    }
    
    
}//fin de la clase gestion_tipoavionDao
