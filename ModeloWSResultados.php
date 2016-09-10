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

        /* array_push($array, "A");
        array_push($array, "B");*/
         return json_encode($array);
    }



    public function getResultadosByIdMuestra ($id_muestra)
    {
       
        $sql = "select id_determinacion,id_paq,resultado FROM detalle_determinaciones_muestra where id_muestra = $id_muestra";

        $rs = $this->db->Execute($sql);

        $arrayResultados = array();

        while(!$rs->EOF)
        {
            $arrayResultados[] = array(
                'id_determinacion' => $rs->fields[0],
                'id_paq'    => $rs->fields[1],
                'resultado' => $rs->fields[2]
                );

            $rs->MoveNext();
        }


            $stringJson= json_encode($arrayResultados);

        //return json_encode($arrayResultados);
            return $stringJson;
    }
 


public function insertResultados ($arrayResultados)
{

    foreach ($arrayResultados as $value) {
            
            $id_muestra = $value['id_muestra'];
            $id_determinacion = $value['id_determinacion'];
            $id_paq = $value['id_paq'];
            $resultado = $value['resultado'];

            $sql = "insert intr resultados (id_muestra,id_determinacion,id_paq,resultado) values($id_muestra,$id_determinacion,$id_paq,$resultado)";
            $rs = $this->db->Execute($sql);
        }

        return "Carga exitosa";

    
}

    public function sum($a, $b)
    {
        return array_sum(func_get_args());
    }
 
    public function getName($name)
    {
        return "Hello " . $name;
    }
}