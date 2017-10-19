<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function createClient($type, $username, $password){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	if (isset($argv[1]))
	{
	  $msg = $argv[1];
	}
	else
	{
	  $msg = "client";
	}

	$request = array();
	$request['type'] = $type;
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = $msg;
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
function createClientDMZ($type, $zip, $radius, $minPrice, $maxPrice, $make, $model, $year){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	$request = array();
	$request['type'] = $type;
	$request['zip'] = $zip;
	$request['radius'] = $radius;
	$request['minPrice'] = $minPrice;
	$request['maxPrice'] = $maxPrice;
	$request['make'] = $make;
	$request['model'] = $model;
	$request['year'] = $year;
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
?>
