<?php
<<<<<<< HEAD
//get all listings
function getListings($request){
	
	$url = "https://jobs.github.com/positions.json?";
	$data = http_build_query($request);

	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url . $data,
	    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	print_r($resp);
	//$json = json_encode($resp);
	return $resp;
}
//get today's listings
function getTodaysListings(){
	//get current date
	date_default_timezone_get();
	$date = date('D M d');
	$resp = "";
	$url = "https://jobs.github.com/positions.json?";
	$todaysListings = a;
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url
	    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	$respArray = json_decode($resp, true);
	for($x = 0; $x < count($respArray); $x++){
		if(strpos($respArray[$x]['created_at'], $date) !== false){
			//$todaysListings .= $respArray[$x];
			if($x == 0){
				$todaysListings = $respArray[$x];}					
			else{
				print("test");
				$todaysListings = array_combine($todaysListings, $respArray[$x]);	}	
		}	
	}

	print_r($todaysListings);
	//$json = json_encode($resp);
	return $todaysListings;
}
//gets all listings by ID
function getListingsByID($request){
	
	$url = "https://jobs.github.com/positions.json?description=";
	$IDs = $request["description"];
	$IDlist = json_decode($IDs);
	$resp = "";
	//print_r($IDlist[0][0]);
	for($x = 0; $x < count($IDlist); $x++){
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url . $IDlist[$x][0],
		    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		if(curl_exec($curl) != "[]"){
		// Send the request & append response to $resp
			if(empty($resp)){
				$resp = curl_exec($curl);
			}
			else{
				$resp = json_encode(array_merge(json_decode($resp),json_decode(curl_exec($curl))));
			}
		//print_r($resp);
		}
		// Close request to clear up some resources
		curl_close($curl);
	}
	print_r($resp);
	//$json = json_encode($resp);
	return ($resp);
}
//get listings based on argument from array
function getGraphData(){
$url = "https://jobs.github.com/positions.json?description=";
	$languages = array("Java", "Python", "C#", "PHP", "HTML", "CSS", "Javascript");
	$languageCounts = array();
	$resp = "";
	//print_r($IDlist[0][0]);
	for($x = 0; $x < count($languages); $x++){
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url . $languages[$x],
		    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$count = count(json_decode($resp));
		$languageCounts[$x] = $count;
		print_r($languageCounts);
		// Close request to clear up some resources
		curl_close($curl);
	}
	$languageCountArray = array_combine($languages, $languageCounts);
	$json = json_encode($languageCountArray);
	print_r($json);
	//$json = json_encode($resp);
	return ($json);	
	
}
//get listings based on skills	
function getRecommendedListings($skills){
	
	$url = "https://jobs.github.com/positions.json?description=";
	$resp = "";
	$skills = json_decode($skills);
	for($x = 0; $x < count($skills); $x++){
		print_r($skills[$x]);
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $url . $skills[$x][0],
		    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		if(curl_exec($curl) != "[]"){
		
		// Send the request & append response to $resp
			if(empty($resp)){
				$resp = curl_exec($curl);
			}
			else{
				
				$resp = json_encode(array_merge(json_decode($resp),json_decode(curl_exec($curl))));
			}
		
		}
		// Close request to clear up some resources
		curl_close($curl);
	}
	//get rid of duplicate entries
	$unique = array_map("unserialize", array_unique(array_map("serialize", json_decode($resp))));
	print_r($unique);
	
	//$json = json_encode($resp);
	return ($unique);
	
=======
function getListings($data){
	
	/*$xml = new SimpleXMLElement('<root/>');
	array_walk_recursive($data, array ($xml, 'addChild'));
	print $xml->asXML();
	$url = "https://api-st.cars.com/InventorySearchService/1.0/rest/partner/inventory/search";
 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
			$output = curl_exec($ch);
			print $output;
			curl_close($ch);*/
	$xml = simplexml_load_file('responseData.xml');
	$json = json_encode($xml);
	//print_r($json);
	$array = json_decode($json, true);
	//print_r($xml);
	return $array;
>>>>>>> 88f287cd5bf03d2b9ca2cf6f5ab7ed121890bf04
}
?>
