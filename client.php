<?php
 
error_reporting(E_ALL);
ini_set("display_errors", 1);

class Client
{
    private $_soapClient = null;
 
    public function __construct()
    {
        require_once(getcwd() . '/lib/nusoap.php');
        //$this->_soapClient= new nusoap_client("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '/Server.php?wsdl');
        $this->_soapClient= new nusoap_client("http://" . $_SERVER['SERVER_NAME'] .'/WebServicesTest/WebService2/server.php');


        //$this->_soapClient= new nusoap_client("http://www.fertilab.com.mx/etiquetas/WebServices/resultados.php");
        ///$this->_soapClient= new nusoap_client("http://www.fertilab.com.mx/etiquetas/WebServices/ws_Resultados.php");

        $this->_soapClient->soap_defencoding = 'UTF-8';
    }

	/**
 * @param $result
 */
private function _soapResponse($result)
{
    
             
        foreach ($result as  $value) {
            
            echo $value['nombre']."-".$value["id_equipo"]."<br>";
        }


     
        

	//print_r($result);
	//echo json_encode($result);
    
   // echo '<h2>Result</h2>';
    //echo '<h2>Request</h2>' . print_r($result);
    echo '<h2>XML Response</h2>';
    echo $this->_soapClient->responseData;
    //echo '<h2>Request</h2>' . htmlspecialchars($this->_soapClient->request, ENT_QUOTES);
    echo '<h2>Response</h2>' . htmlspecialchars($this->_soapClient->response, ENT_QUOTES);
    //echo '<h2>Debug</h2>' . htmlspecialchars($this->_soapClient->debug_str, ENT_QUOTES);
}

    public function users()
{
    try
    {
        $result = $this->_soapClient->call('Service.getUsers', array());
        $this->_soapResponse($result);
    }
    catch (SoapFault $fault)
    {
        trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    }
}


    public function getresultados()
    {
        try
        {
            $result = $this->_soapClient->call('WsResultados.getResultadosByIdMuestra', array('id_muestra' => 85));
            $this->_soapResponse($result);
        }
        catch (SoapFault $fault)
        {
            trigger_error("SSOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring} )", E_USER_ERROR);
        }
    }


 
public function sum()
{
    try
    {
        $result = $this->_soapClient->call('Service.sum', array('a' => 1, 'b' => 5));
        $this->_soapResponse($result);
    }
    catch (SoapFault $fault)
    {
        trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    }
}
 
public function getName()
{
    try
    {
        $result = $this->_soapClient->call('Service.getName', array('name' => 'Iparra'));
        $this->_soapResponse($result);
 
    }
    catch (SoapFault $fault)
    {
        trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
    }
}




}