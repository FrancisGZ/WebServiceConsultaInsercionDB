<?
error_reporting(E_ALL);
ini_set("display_errors", 1);
include('Conexion.php');
/**
* 
*/
class ClienteWsResultados {

	private $_soapClient =  null;
	//private $db;

	public function __construct()
	{
		require_once(getcwd() . '/lib/nusoap.php');

		try
		{
		$this->_soapClient= new nusoap_client("http://" . $_SERVER['SERVER_NAME'] .'/WebServiceResultados/ws_InsertaResultados.php');
		}
		catch(Exception $e) {
    		echo $e->getMessage();

		}
		//$this->_soapClient= new nusoap_client("https://www.fertilab.com.mx/etiquetas/WebServices/ws_InsertaResultados.php?wsdl");
		$this->_soapClient->soap_defecoding = 'UTF-8';

		//$objCon = new conexo();

       // $this->db = $objCon->conectar();
	}





/*    function __construct() {

        $objCon = new conexo();

        $this->db = $objCon->conectar();

    }*/


    private function _soapResponse($result)
	{
    /*	foreach ($result as  $value) {
            
            echo $value;
        
        }*/
             
      echo $result;
	}

	

	public function convertir($arrayResultados)
	{
		return $arrayResultados;
	}


	


	public function sendResultados($id_muestra)
	{	

				

	
		$con = new conexo();
        $db = $con->conectar();

		$sql = "select id_muestra,id_determinacion,id_paq,status,resultado from resultados_muestras_final where id_muestra = $id_muestra";
		$rsResultados  = $db->Execute($sql); 
		$arrayResultados= array();



		
		while (!$rsResultados->EOF) 
		{
			$arrayResultados[] = array(
					'id_muestra' => $rsResultados->fields[0],
					'id_determinacion' => $rsResultados->fields[1],
					'id_paq' => $rsResultados->fields[2],
					'status' => $rsResultados->fields[3],
					'resultado' =>$rsResultados->fields[4]
				);	
			

				$rsResultados->MoveNext();


		}

		try
		{

			$result = $this->_soapClient->call('WsResultados.insertResultados', $arrayResultados);
			$this->_soapResponse($result);
		}
		catch (Soapfault $fault)
		{
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
		/* foreach ($arrayResultados as  $value) {
            
             echo $id_muestra = $value['id_muestra'];
             echo $id_determinacion = $value['id_determinacion'];
             echo $id_paq = $value['id_paq'];
             echo $status = $value['status'];
             echo $resultado = $value['resultado'];      

	}*/

}



	public function sendResultados123($id_muestra, $id_determinacion,$id_paq, $status, $resultado)
	{	

					/*echo "Muestra: ".$id_muestra;
					echo "-Determinacion: ".$id_determinacion; 
					echo "-Paquete: ".$id_paq; 
					echo "-Estatus: ".$status;
					echo "-Resultados: ".$resultado ;
					echo "<br>";

		try
				{

				$result = $this->_soapClient->call('WsResultados.insertResultados', array('id_muestra' => $id_muestra, 'id_determinacion' => $id_determinacion, 'id_paq' => $id_paq, 'status' => $status, 'resultado' => $resultado));
					$this->_soapResponse($result);
				}
			catch (Soapfault $fault)
				{
					trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
				}*/

	
		$con = new conexo();
        $db = $con->conectar();

		$sql = "select id_muestra,id_determinacion,id_paq,status,resultado from resultados_muestras_final where id_muestra = $id_muestra";
		$rsResultados  = $db->Execute($sql); 
		$arrayResultados= array();



		
		while (!$rsResultados->EOF) 
		{
			$arrayResultados[] = array(
					'id_muestra' => $rsResultados->fields[0],
					'id_determinacion' => $rsResultados->fields[1],
					'id_paq' => $rsResultados->fields[2],
					'status' => $rsResultados->fields[3],
					'resultado' =>$rsResultados->fields[4]
				);	
			

					


			/*try
				{

					$result = $this->_soapClient->call('WsResultados.insertResultados', array('id_muestra' => $id_muestra, 'id_determinacion' => $id_determinacion, 'id_paq' => $id_paq, 'status' => $status, 'resultado' => $resultado));
					$this->_soapResponse($result);
				}
			catch (Soapfault $fault)
				{
					trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
				}*/


				$rsResultados->MoveNext();


		}

		

	try
		{

			$result = $this->_soapClient->call('WsResultados.insertResultados', $arrayResultados);
			$this->_soapResponse($result);
		}
		catch (Soapfault $fault)
		{
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}




		

       /*foreach ($arrayResultadosConvert as  $value) {
            
             echo $id_muestra = $value['id_muestra'];
             echo $id_determinacion = $value['id_determinacion'];
             echo $id_paq = $value['id_paq'];
             echo $status = $value['status'];
             echo $resultado = $value['resultado']."<br>";
             
              try
				{

					$result = $this->_soapClient->call('WsResultados.insertResultados', array('id_muestra' => $id_muestra, 'id_determinacion' => $id_determinacion, 'id_paq' => $id_paq, 'status' => $status, 'resultado' => $resultado));
					$this->_soapResponse($result);
				}
			catch (Soapfault $fault)
				{
					trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
				}


        
        }*/
        		//echo $arrayJson = json_encode($arrayResultados);

       


        

		/*try
		{

			$result = $this->_soapClient->call('WsResultados.insertResultados', $arrayResultados);
			$this->_soapResponse($result);
		}
		catch (Soapfault $fault)
		{
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}*/

	}



}