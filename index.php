<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//include('Conexion.php');
/*require_once(getcwd() . '/Client.php');
$client = new Client();
$client->getName();*/


require_once(getcwd() . '/ClienteWsResultados.php');

$client = new ClienteWsResultados();
$client->sendResultados(4109);
/*


		$con = new conexo();
        $db = $con->conectar();

		$sql = "select id_muestra,id_determinacion,id_paq,status,resultado from resultados_muestras_final where id_muestra = 4109";
		$rsResultados  = $db->Execute($sql); 
		//$arrayResultados= array();


		//var_dump($rsResultados);


		//$numero = 0;
		while (!$rsResultados->EOF) 
		{
			/*$arrayResultados[] = array(
					'id_muestra' => $rsResultados->fields[0],
					'id_determinacion' => $rsResultados->fields[1],
					'id_paq' => $rsResultados->fields[2],
					'status' => $rsResultados->fields[3],
					'resultado' =>$rsResultados->fields[4]
				);*/
			
				/*	$arrayResultados = array(
					 $rsResultados->fields[0],
					 $rsResultados->fields[1],
					 $rsResultados->fields[2],
					 $rsResultados->fields[3],
					 $rsResultados->fields[4]
				);


					

					$arrayImplode= implode(",",$arrayResultados);

					//echo $arrayImplode."<br>";

					$valor = explode(",",$arrayImplode);

					 $id_muestra =(string)$valor[0];
					 $id_determinacion = (string)$valor[1];
					 $id_paq = (string)$valor[2];
					 $status = (string)$valor[3];
					 $resultado = (string)$valor[4];		
				

					/*$id_muestra =$rsResultados->fields[0];
					$id_determinacion = $rsResultados->fields[1];
					$id_paq = $rsResultados->fields[2];
					$status = $rsResultados->fields[3];
					$resultado = $rsResultados->fields[4];			*/
					

					/*echo "Muestra: ".$id_muestra =$rsResultados->fields[0];
					echo "-Determinacion: ".$id_determinacion = $rsResultados->fields[1];
					echo "-Paquete: ".$id_paq = $rsResultados->fields[2];
					echo "-Estatus: ".$status = $rsResultados->fields[3];
					echo "-Resultados: ".$resultado = $rsResultados->fields[4];			
					echo "<br>";*/

					/*$id_muestra ="9";
					 $id_determinacion = "8";
					 $id_paq = "7";
					 $status = "6";
					 $resultado = "5";	*/

				//$client->sendResultados(4109);


				/*$client->sendResultados($id_muestra, $id_determinacion, $id_paq, $status, $resultado);
				
				$rsResultados->MoveNext();


		}*/
