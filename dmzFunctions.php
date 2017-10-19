<?php
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
}
?>
