<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

<<<<<<< HEAD
//create a new rabbitmq client instance for the database server
function createClient($request){
=======
function createClient($type, $username, $password){
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	if (isset($argv[1]))
	{
	  $msg = $argv[1];
	}
	else
	{
	  $msg = "client";
	}
<<<<<<< HEAD
	//send a response request with the data
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
	print_r($response);
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
//create a new rabbitmq client instance for the DMZ server
function createClientDMZ($request){
	$client = new rabbitMQClient("testRabbitMQ_DMZ.ini","testServer");
	//send a response request with the data
=======

	$request = array();
	$request['type'] = $type;
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = $msg;
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
<<<<<<< HEAD
=======
	print_r($response);
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
<<<<<<< HEAD

//create a new rabbitmq client instance for the backup server
function createClientBackup($request){
	$client = new rabbitMQClient("testRabbitMQ_backup.ini","testServer");
	//send a response request with the data
=======
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
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	return $response;
	echo "client received response: ".PHP_EOL;
<<<<<<< HEAD
=======
	print_r($response);
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
	echo "\n\n";

	echo $argv[0]." END".PHP_EOL;
}
?>
