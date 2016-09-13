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
		 $_soapServer->register(
		 		'WsResultados.insertResultados',
		 		array('id_muestra' => 'xsd:string', 'id_determinacion' => 'xsd:string', 'id_paq' => 'xsd:string', 'status' => 'xsd:string', 'resultado' => 'xsd:string' ),
		 		//array('id_muestra' => 'xsd:string', 'id_determinacion' => 'xsd:string', 'id_paq' => 'xsd:string', 'status' => 'xsd:string', 'resultado' => 'xsd:string', ),
		 		array('return' => 'xsd:string'),
		 		$ns,
		 		false,
		 		'rpc',
		 		'encoded',
		 		'Servicio web que inserta resultados'
		 	);

		  
		 	/*$server->configureWSDL('server', 'urn:server');
			$server->wsdl->schemaTargetNamespace = 'urn:server';	
		  	$_soapServer->register('WsResultados.insertResultados',
		  	array('name' => 'xsd:string'),        
            array('return' => 'xsd:string'),
            'urn:server',
            'urn:server#getrequest');*/

		
		/*  	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

			$server->service($HTTP_RAW_POST_DATA);*/

		$_soapServer->service(file_get_contents("php://input"));
	}
}

$server = new ws_InsertaResultados();