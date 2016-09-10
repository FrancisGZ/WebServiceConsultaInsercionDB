<?php

include('Conexion.php');


class Service
{


    function Conexion() {
        $Conexion = new conexo();
        $db = $Conexion->conectar();
        return $db;
    }


    public function getUsers()
    {
        /*return [
          ["id" => 1, "name" => "Iparra"],
          ["id" => 2, "name" => "Juan"],
          ["id" => 3, "name" => "Leonardo"]
        ];*/


        $con = new conexo();
        $db = $con->conectar();
        $sql = "select id_equipo,nombre from equipo where id_categoria = 1 ";
        $rs = $db->Execute($sql);

        $array = array();

        //array_push($array, "A");
        //array_push($array, "B");

        

        while(!$rs->EOF)
        {
           //array_push($array,  $rs->fields[0]);


            $array[] = array(
              'id_equipo' => $rs->fields[0],
              'nombre' => $rs->fields[1]
           );


            $rs->MoveNext();
        }

         return json_encode($array);

        //return $rs;

    //  return json_encode($array);

    }
 
    public function sum($a, $b)
    {
        return array_sum(func_get_args());
    }
 
    public function getName($name)
    {


        $con = new conexo();
        $db = $con->conectar();
        $sql = "select id_equipo,nombre from equipo where id_categoria = 1 ";
        $rs = $db->Execute($sql);

        $array = array();

        

        while(!$rs->EOF)
        {
           

            $array[] = array(
              'id_equipo' => $rs->fields[0],
              'nombre' => $rs->fields[1]
           );


            $rs->MoveNext();
        }

        $arrayJson = json_encode($array);

        $arrayString = json_decode($arrayJson, true);

        $numero= count($arrayString);

       /* $string="";
        foreach ($arrayString as  $value) {
            
            $string = $string.$value['nombre'];
        }

        return $string;*/

        return $array;
    }
}