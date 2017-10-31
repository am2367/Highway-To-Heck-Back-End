<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function createClient($request){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	if (isset($argv[1]))
	{
	  $msg = $argv[1];
	}
	else
	{
	  $msg = "client";
	}
		
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
function createClientDMZ($request){
	$client = new rabbitMQClient("testRabbitMQ_DMZ.ini","testServer");
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
?>
