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
	echo "Hello!".PHP_EOL;
	$register = new connectdb();

	$output = $register->register($username,$password);

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

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      $status = doLogin($request['username'],$request['password']);
      break;
    case "register":
      $status = doRegister($request['username'],$request['password']);
      break;
    case "validate_session":
      $status = doValidate($request['sessionId']);
      break;
  }
 
  return array("status" => $status, 'message'=>"Server received request and processed");
}

//create new server
$server = new rabbitMQServer("testRabbitMQ_DB.ini","testServer");
//process the request
$server->process_requests('requestProcessor');

exit();
?>

