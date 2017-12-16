#!/usr/bin/php
<?php
include("writeLogs.php");
/*
handles dmz requests from the server

@author  Alex Markenzon
@since   October
@version 5
*/

echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("dmzFunctions.php");

//routes requests from server
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
    case "watchlist":
      $data = getListingsByID($request);
      break;
    case "graphData":
      $data = getGraphData();
      break;
    case "getTodaysListings":
      $data = getTodaysListings();
      break;
    case "recommendedListings":
      $data = getRecommendedListings($request['skills']);
      break;
  }
  ///return $data;
  writeLogsDMZ("Returned listings from DMZ");
  return $data;
}

//create new server
$server = new rabbitMQServer("rabbitMQ_DMZ.ini","testServer");
//process the request
$server->process_requests('requestProcessor');

exit();
?>

