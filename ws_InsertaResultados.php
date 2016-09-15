<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);


class ws_InsertaResultados
{
	private $_soapServer = null;

	public function __construct()
	{
		 require_once(getcwd() . '/lib/nusoap.php');
		 require_once(getcwd() . '/ModeloWSResultados.php');

		 $_soapServer = new soap_server();
		 $_soapServer->configureWSDL("ServicioWSDL");
		 $ns = "urn:miserviciowsdl";


		 $_soapServer->wsdl->addComplexType('MyComplexType','complexType','struct','all','',
        array( 
        		'id_muestra' => array('name' => 'id_muestra','type' => 'xsd:string'),
               	'id_determinacion' => array('name' => 'id_determinacion','type' => 'xsd:string'),
               	'id_paq' => array('name' => 'id_paq','type' => 'xsd:string'),
               	'status' => array('name' => 'status','type' => 'xsd:string'),
               	'resultado' => array('name' => 'resultado','type' => 'xsd:string'),
               	));


		 $_soapServer->register(
		 		'WsResultados.insertResultados',
		 		array(),
		 		//array('id_muestra' => 'xsd:string', 'id_determinacion' => 'xsd:string', 'id_paq' => 'xsd:string', 'status' => 'xsd:string', 'resultado' => 'xsd:string' ),
		 		array('return' => 'xsd:MyComplexType'),
		 		//array('return' => 'xsd:string'),
		 		false,
		 		false,
		 		'rpc',
		 		'encoded',
		 		'Servicio web que inserta resultados'
		 	);

		  
		 

		$_soapServer->service(file_get_contents("php://input"));
	}
}

$server = new ws_InsertaResultados();