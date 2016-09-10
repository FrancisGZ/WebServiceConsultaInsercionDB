<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
 
/*class Server
{*/
    //private $_soapServer = null;
 
    //public function __construct()
    //{
	$ns = "urn:miserviciowsdl";
        require_once(getcwd() . '/lib/nusoap.php');
        require_once(getcwd() . '/service.php');


        $_soapServer = new soap_server();
        $_soapServer->configureWSDL("Servicio WSDL");

        $_soapServer->register(
	   'Service.getUsers', // method name
	   array(), // input parameters
	   array('return' => 'xsd:Array'), // output parameters
	   $ns, // namespace
	   false, // soapaction
	   'rpc', // style
	   'encoded', // use
	   'Servicio que retorna un array de usuarios' // documentation
	);
	 
	/*$this->_soapServer->register(
	    'Service.sum',
	    array('a' => 'xsd:string', 'b' => 'xsd:string'),
	    array('return' => 'xsd:int'), 
	    false,
	    false,
	    "rpc",
	    "encoded",
	    "Servicio que suma dos números"
	);*/
	 
	$_soapServer->register(
	    "Service.getName",
	    array('name' => "xsd:string"),
	    array("return" => "xsd:Array"),
	    false,
	    false,
	    "rpc",
	    "encoded",
	    "Servicio que retorna un string"
	);
	 
//procesamos el webservice
$_soapServer->service(file_get_contents("php://input"));
  //  }
//}


//$server = new Server();