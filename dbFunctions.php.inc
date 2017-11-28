<?php

class connectdb
{
private $connectdb;

public function __construct()
{
	$this->connectdb = new mysqli("127.0.0.1","root","it490","login");//Your DB info here (localhost, mysql root, mysql pass, database)

	if ($this->connectdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->connectdb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}
//Not currently in use
/*public function validateLogin($username,$password)
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
}*/
//Register user
public function register($username,$password, $email)
{	
	$un = $this->connectdb->real_escape_string($username);
	$pw = $this->connectdb->real_escape_string($password);
	$email = $this->connectdb->real_escape_string($email);
	$statement = "INSERT INTO users(screenname, password) VALUES ('$un', '$pw','$email');";
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
<<<<<<< HEAD

public function makes($make)
{
	$make = $this->connectdb->real_escape_string($make);
	$statement = "SELECT ma.name AS make, mo.name AS model FROM models mo
    			JOIN make_years my on mo.makeyear_id = my.id
    			JOIN makes ma on ma.id = my.make_id
    			WHERE ma.name = '$make'
    			ORDER BY model;";
	$results = array();
	while($row = mysql_Fetch_array($statement))
	{
		$results[] = array(
			'make' => $row['make'],
			'model' => $row['model'],
		);
	}
	$json = json_encode($results);
}
	
public function models($make, $year)
{
	$make = $this->connectdb->real_escape_string($make);
	$year = $this->connectdb->real_escape_string($year);
	$statement = "SELECT my.year, ma.name AS make, mo.name AS model FROM models mo
    			JOIN make_years my on mo.makeyear_id = my.id
    			JOIN makes ma on ma.id = my.make_id
    			WHERE ma.name = '$make' and my.year = '$year'
    			ORDER BY model;";
	$results = array();
	while($row = mysql_Fetch_array($statement))
	{
		$results[] = array(
			'year' => $row['year'],
			'make' => $row['make'],
			'model' => $row['model'],
		);
	}
	$json = json_encode($results);
}
	
public function years($make, $model)
{
	$make = $this->connectdb->real_escape_string($make);
	$model = $this->connectdb->real_escape_string($model);
	$statement = "SELECT my.year, ma.name AS make, mo.name AS model FROM models mo
    			JOIN make_years my on mo.makeyear_id = my.id
    			JOIN makes ma on ma.id = my.make_id
   			WHERE ma.name = '$make' and mo.name LIKE '$model'
    			ORDER BY my.year, model;";
	$results = array();
	while($row = mysql_Fetch_array($statement))
	{
		$results[] = array(
			'year' => $row['year'],		
			'make' => $row['make'],
			'model' => $row['model'],
		);
	}
	$json = json_encode($results);
=======
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
>>>>>>> ea40da0c1a977abdd592e12fe56f3786d21c0aed
}
	


}







?>

