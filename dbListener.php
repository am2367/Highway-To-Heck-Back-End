#!/usr/bin/php
<?php
include("writeLogs.php");
/*
handles requests from server to db functions

@author  Alex Markenzon
@since   September
@version 5
*/

echo "ServerStarted!".PHP_EOL;
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once("dbFunctions.php.inc");

//login
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

//register
function doRegister($username,$password, $email){
	$register = new connectdb();

	$output = $register->register($username,$password, $email);

	if($output){
		echo "registration successful".PHP_EOL;
		return true;
	}
	else{
		echo "registration failed".PHP_EOL;
		echo ($output).PHP_EOL;
		return false;
	}
}

//add to watchlist
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

//remove from watchlist
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

//clear watchlist
function doClearWatchlist($user){
	$remove = new connectdb();

	$output = $remove->clearWatchlist($user);

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

//retrieve listings from watchlist
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
		return "No listings";
	}
}

//add skill
function doAddSkill($user,$skill){
	$add = new connectdb();

	$output = $add->addSkill($user, $skill);

	if($output){
		echo "Added!".PHP_EOL;
		echo  var_dump($output).PHP_EOL;
		return $output;
	}
	else{
		echo "Not Added!".PHP_EOL;
		return false;
	}
}

//rewmove skill
function doRemoveSkill($user,$skill){
	$remove = new connectdb();

	$output = $remove->removeSkill($user, $skill);

	if($output){
		echo "Removed!".PHP_EOL;
		echo  var_dump($output).PHP_EOL;
		return $output;
	}
	else{
		echo "Not Removed!".PHP_EOL;
		return false;
	}
}

//get skills
function doGetSkills($user){
	$retrieve = new connectdb();

	$output = $retrieve->getSkills($user);

	if($output){
		echo "Retrieved Skills!".PHP_EOL;
		echo  var_dump($output).PHP_EOL;
		return $output;
	}
	else{
		echo "No Skills Retreived!".PHP_EOL;
		return false;
	}
}

//get email
function doGetEmail($user){
	$retrieve = new connectdb();

	$output = $retrieve->getEmail($user);

	if($output){
		echo "Retrieved Email!".PHP_EOL;
		echo  var_dump($output).PHP_EOL;
		return $output;
	}
	else{
		echo "No Email Retreived!".PHP_EOL;
		return false;
	}
}


//route requests from server
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
    case "getUserEmail":
      $status = doGetEmail($request['username']);
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
    case "clearWatchlist":
      $status = doClearWatchlist($request['user']);
      break;
    case "getListingsFromWatchlist":
      $status = doRetrieveFromWatchlist($request['user']);
      break;
    case "addSkill":
      $status = doAddSkill($request['user'], $request['skill']);
      break;
    case "removeSkill":
      $status = doRemoveSkill($request['user'], $request['skill']);
      break;
    case "getSkills":
      $status = doGetSkills($request['user']);
      break;
  }
  writeLogsDB($status);
  return array('status' => $status,'message'=>'Database server received request and processed');
}

//create new server
$server = new rabbitMQServer("rabbitMQ_DB.ini","testServer");
//process the request
$server->process_requests('requestProcessor');

exit();
?>

