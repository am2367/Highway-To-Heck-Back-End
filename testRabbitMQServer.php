#!/usr/bin/php
<?php
echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  switch ($request["type"])
  {
	case "login":
		$client = new rabbitMQClient("testRabbitMQ_DB.ini","testServer");
		$response = $client->send_request($request);
	break;
	case "register":
		$client = new rabbitMQClient("testRabbitMQ_DB.ini","testServer");
		$response = $client->send_request($request);
	break;
	case "listings":
		$client = new rabbitMQClient("testRabbitMQ_DMZ.ini","testServer");
		$response = $client->send_request($request);
	break;
  }
  
  return $response;
  //return array("stats" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

