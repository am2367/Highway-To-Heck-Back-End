#!/usr/bin/php
<?php
echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("dmzFunctions.php");

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['data']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['data'])
  {
    case "listings":
      $data = getListings($request);
      break;
  }
  ///return $data;
  return $data;
}

//create new server
$server = new rabbitMQServer("testRabbitMQ_DMZ.ini","testServer");
//process the request
$server->process_requests('requestProcessor');

exit();
?>

