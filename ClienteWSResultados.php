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
		$this->_soapClient= new nusoap_client("http://" . $_SERVER['SERVER_NAME'] .'WebServiceResultados/ws_InsertaResultados.php');

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
    
             
       /* foreach ($result as  $value) {
            
            echo $value['nombre']."-".$value["id_equipo"]."<br>";
        }*/
        echo $result;

	}

	public function sendResultados($id_muestra)
	{	


		$con = new conexo();
        $db = $con->conectar();

		$sql = "select id_muestra,id_determinacion,id_paq,resultado from resultados_muestras_final where id_muestra = $id_muestra";
		$rsResultados  = $db->Execute($sql); 
		$arrayResultados= array();

		while (!$rsResultados->EOF) 
		{
			$arrayResultados[] = array(
					'id_muestra' => $rsResultados->fields[0],
					'id_determinacion' => $rsResultados->fields[1],
					'id_paq' => $rsResultados->fields[2],
					'resultado' =>$rsResultados->fields[3]
				);	
			$rsResultados->MoveNext();
		}


		try
		{

			$result = $this->_soapClient->call('WsResultados.insertResultados', "cadena");
			$this->_soapResponse($result);
		}
		catch (Soapfault $fault)
		{
			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
	}
}