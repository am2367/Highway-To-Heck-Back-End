#!/usr/bin/php
<?php
echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("dbFunctions.php.inc");

function doLogin($username,$password)
{
	$login = new connectdb();

	$output = $login->validateLogin($username,$password);

	if($output){
		echo "login successful".PHP_EOL;
		return true;
	}
	else{
		echo "login failed".PHP_EOL;
		return false;
	}
}

function doRegister($username,$password){
	$register = new connectdb();

	$output = $register->register($username,$password);

	if($output){
		echo "registration successful".PHP_EOL;
		return true;
	}
	else{
		echo "registration failed".PHP_EOL;
		echo ($output).PHP_EOL;
		echo ($output).PHP_EOL;
		return false;
	}
}
function doAddToWatchlist($user, $listingID){
	$add = new connectdb();

	$output = $add->addToWatchlist($user, $listingID);

	if($output){
		echo "Added Successfully!".PHP_EOL;
		return true;
	}
	else{
		echo "Error Adding!".PHP_EOL;
		echo ($output).PHP_EOL;
		return false;
	}
}
function doRemoveFromWatchlist($user, $listingID){
	$remove = new connectdb();

	$output = $remove->removeFromWatchlist($user, $listingID);

	if($output){
		echo "Removed Successfully!".PHP_EOL;
		return true;
	}
	else{
		echo "Error Removing!".PHP_EOL;
		echo ($output).PHP_EOL;
		return false;
	}
}
function doRetrieveFromWatchlist($user){
	$retrieve = new connectdb();

	$output = $retrieve->retrieveFromWatchlist($user);

	if($output){
		echo "Retrieved Watchlist Listings!".PHP_EOL;
		echo  var_dump($output).PHP_EOL;
		return $output;
	}
	else{
		echo "No listings retrieved!".PHP_EOL;
		return false;
	}
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['data']))
  {
    return array('message'=>"ERROR: unsupported message type");
  }
  switch ($request['data'])
  {
    case "login":
      $status = doLogin($request['username'],$request['password']);
      break;
    case "register":
      $status = doRegister($request['username'],$request['password'],$request['email']);
      break;
    case "validate_session":
      $status = doValidate($request['sessionId']);
      break;
    case "addToWatchlist":
      $status = doAddToWatchlist($request['user'], $request['listingID']);
      break;
    case "removeFromWatchlist":
      $status = doRemoveFromWatchlist($request['user'], $request['listingID']);
      break;
    case "getListingsFromWatchlist":
      $status = doRetrieveFromWatchlist($request['user']);
      break;
  }
 
  return array('status' => $status,'message'=>'Server received request and processed');
}

//create new server
$server = new rabbitMQServer("testRabbitMQ_DB.ini","testServer");
//process the request
$server->process_requests('requestProcessor');

exit();
?>

