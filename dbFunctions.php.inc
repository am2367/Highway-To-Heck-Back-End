<?php

/*
handles database functions

@author  Alex Markenzon
@since   September
@version 5
*/
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

//validates the user's credentials
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
public function register($username,$password, $email)
{	
	$un = $this->connectdb->real_escape_string($username);
	$pw = $this->connectdb->real_escape_string($password);
	$email = $this->connectdb->real_escape_string($email);
	$statement = "INSERT INTO users(screenname, password, email) VALUES ('$un', '$pw','$email');";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}
//add listing for given user
public function addToWatchlist($user, $listingID)
{	
	$statement = "INSERT INTO userWatchList(user, listingID) VALUES ('$user', '$listingID');";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}
//remove listing for given user
public function removeFromWatchlist($user, $listingID)
{	
	$statement = "DELETE FROM userWatchList WHERE user='$user' AND listingID='$listingID';";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}

//remove all listing for given user
public function clearWatchlist($user)
{	
	$statement = "DELETE FROM userWatchList WHERE user='$user'";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}

//return all listings for given user
public function retrieveFromWatchlist($user)
{	
	$statement = "SELECT listingID FROM userWatchList WHERE user='$user'";
	$query = $this->connectdb->query($statement);
	$response = $query->fetch_all();
	if ($response){
		return $response;
	}
	else{
		return 0;
		
	}
}

//adds a skill to the db
public function addSkill($user, $skill)
{	
	$statement = "INSERT INTO skills(user, skill) VALUES ('$user', '$skill');";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}

//removes a skill from the db
public function removeSkill($user, $skill)
{	
	$statement = "DELETE FROM skills WHERE user='$user' AND skill='$skill';";
	$response = $this->connectdb->query($statement);
	if ($response){
		return 1;
	}
	else{
		return 0;	
	}
}

//retrieves a skill from the db
public function getSkills($user)
{	
	$statement = "SELECT skill FROM skills WHERE user='$user'";
	$query = $this->connectdb->query($statement);
	$response = $query->fetch_all();
	if ($response){
		return $response;
	}
	else{
		return 0;
		
	}
}

//retrieves the email for the passed user
public function getEmail($user)
{	
	$statement = "SELECT email FROM users WHERE screenname='$user'";
	$query = $this->connectdb->query($statement);
	$response = $query->fetch_assoc();
	if ($response){
		return $response;
	}
	else{
		return 0;
		
	}
}

}
?>
