<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
include 'Conexion.php';



class WsResultados
{


   /* function Conexion() {
        $Conexion = new conexo();
        $db = $Conexion->conectar();
        return $db;
    }*/


        private $db;


    function __construct() {

        $objCon = new conexo();

        $this->db = $objCon->conectar();

    }


    public function getUsers()
    {
       

        $con = new conexo();
        $db = $con->conectar();
        $sql = "select id_paquete,fecha from paquetes where id_usuario = 10";
        $rs = $db->Execute($sql);

        $array = array();   

        while(!$rs->EOF)
        {
           

            $array[] = array(
              'id_paquete' => $rs->fields[0],
              'fecha' => $rs->fields[1]
           );


            $rs->MoveNext();
        }

        
         return json_encode($array);
    }



   
 


public function insertResultados ($arrayResultados)
{
    /*$sql = "insert into detalle_determinaciones_muestra (id_muestra,id_determinacion,id_paq,status,resultado) values(1,2,3,4,5)";
    $rs = $this->db->Execute($sql);*/
                
    foreach ($arrayResultados as $value) {
            
            $id_muestra = $value['id_muestra'];
            $id_determinacion = $value['id_determinacion'];
            $id_paq = $value['id_paq'];
            $status = $value['status'];
            $resultado = $value['resultado'];
            $sql = "insert into detalle_determinaciones_muestra (id_muestra,id_determinacion,id_paq,status,resultado) values($id_muestra,$id_determinacion,$id_paq,$status,$resultado)";
            $rs = $this->db->Execute($sql);
        }

        return "Carga Exitosa";

    
}

        public function insertResultados123 ($id_muestra,$id_determinacion,$id_paq,$status,$resultado)
    {
                //$sql = "insert into detalle_determinaciones_muestra (id_muestra,id_determinacion,id_paq,status,resultado) values(1,2,3,4,5)";
                $sql = "insert into detalle_determinaciones_muestra_detalle (id_muestra,id_determinacion,id_paq,status,resultado) values($id_muestra,$id_determinacion,$id_paq,$status,$resultado)";
                $rs = $this->db->Execute($sql);
                

            return "Carga Exitosa";

        
    }



    
    
}