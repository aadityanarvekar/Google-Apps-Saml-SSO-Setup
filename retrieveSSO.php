<?php
	
	$accessToken = $_GET['accessToken'];
	$domain = $_GET['domain'];
	
	$uri = "https://apps-apis.google.com/a/feeds/domain/2.0/".$domain."/sso/general";
	//echo "<br />".$uri;
	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $uri);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	    'Authorization: Bearer '.$accessToken));
	curl_setopt($ch, CURLOPT_HEADER, false);
		

	$data = curl_exec($ch); 
	curl_close($ch);
	
	
	$xml = new SimpleXMLElement($data);
	$id = $xml->id;
	echo $id;


	
?>