<?php

class connectdb
{
private $connectdb;

public function __construct()
{
	$this->connectdb = new mysqli("127.0.0.1","root","201alex","login");//Your DB info here (localhost, mysql root, mysql pass, database)

	if ($this->connectdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->connectdb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

public function validateLogin($username,$password)
{
	$un = $this->connectdb->real_escape_string($username);
	$pw = $this->connectdb->real_escape_string($password);
	$statement = "select * from users where screenname = '$un';";
	$response = $this->connectdb->query($statement);

	while ($row = $response->fetch_assoc())
	{
		echo "checking password for $username".PHP_EOL;
		if ($row["password"] == $pw)
		{
			echo "passwords match for $username".PHP_EOL;
			return 1;// password match
		}
		echo "passwords did not match for $username".PHP_EOL;
	}
	return 0;//no users matched username
}
//Register user
public function register($username,$password)
{	
	$un = $this->connectdb->real_escape_string($username);
	$pw = $this->connectdb->real_escape_string($password);
	$statement = "insert into users (screenname, password) values ($un, $pw);";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}
}
?>
