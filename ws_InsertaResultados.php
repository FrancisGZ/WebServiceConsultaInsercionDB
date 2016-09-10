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
		 		array('arrayResultados' => 'xsd:string'),
		 		array('return' => 'xsd:string'),
		 		$ns,
		 		false,
		 		'rpc',
		 		'encoded',
		 		'Servicio web que inserta resultados'
		 	);

		 $_soapServer->service(file_get_contents("php://input"));
	}
}

$server = new ws_InsertaResultados();