<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/*require_once(getcwd() . '/Client.php');
$client = new Client();
$client->getName();*/

require_once(getcwd() . '/ClienteWsResultados.php');
$client = new ClienteWsResultados();
$client->sendResultados(4109);