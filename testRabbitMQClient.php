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
	$request['type'] = $type;//$_GET["type"];
	$request['username'] = $username;//$_GET["username"];
	$request['password'] = $password;//$_GET["password"];
	$request['message'] = $msg;
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
?>
