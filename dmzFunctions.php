<?php
function getListings($request){
	
	$url = "https://jobs.github.com/positions.json?";
	$data = http_build_query($request);

	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url . $data,
	    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	print_r($resp);
	//$json = json_encode($resp);
	return $resp;
}
?>
