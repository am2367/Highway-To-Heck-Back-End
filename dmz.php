#!/usr/bin/php
<?php
echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("dmzFunctions.php");

<<<<<<< HEAD
=======
function listListings($request){
	return getListings($request);
}

>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
<<<<<<< HEAD
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
=======
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "listings":
      $data = listListings($request);
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
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

