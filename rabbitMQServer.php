#!/usr/bin/php
<?php

/*
handles client creation for communication to specific servers

@author  Alex Markenzon
@since   September
@version 5
*/

echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//routes requests from client
function requestProcessor($request)
{
  echo "Received Request!";	
  switch ($request["data"])
  {
	case "login":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "register":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "getUserEmail":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "addToWatchlist":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "removeFromWatchlist":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "clearWatchlist":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "getListingsFromWatchlist":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "listings":
		$client = new rabbitMQClient("rabbitMQ_DMZ.ini","testServer");
		//send data to DMZ and store response
		$response = $client->send_request($request);
	break;
	case "watchlist":
		$client = new rabbitMQClient("rabbitMQ_DMZ.ini","testServer");
		//send data to DMZ and store response
		$response = $client->send_request($request);
	break;
	case "recommendedListings":
		$client = new rabbitMQClient("rabbitMQ_DMZ.ini","testServer");
		//send data to DMZ and store response
		$response = $client->send_request($request);
	break;
	case "getTodaysListings":
		$client = new rabbitMQClient("rabbitMQ_DMZ.ini","testServer");
		//send data to DMZ and store response
		$response = $client->send_request($request);
	break;
	case "addSkill":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "removeSkill":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
	case "getSkills":
		$client = new rabbitMQClient("rabbitMQ_DB.ini","testServer");
		//send data to database and store response
		$response = $client->send_request($request);
	break;
  }
  
  return $response;
}
//create new rabbitmq server instance
$server = new rabbitMQServer("rabbitMQ.ini","testServer");
//handle all incoming requests
$server->process_requests('requestProcessor');
exit();
?>

