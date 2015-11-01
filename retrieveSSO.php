<?php
	
	$accessToken = $_GET['accessToken'];
	$domain = $_GET['domain'];
	
	$uri = "https://apps-apis.google.com/a/feeds/domain/2.0/".$domain."/sso/general";
	//echo "<br />".$uri;
	
	$ch = curl_init(); 
	$hdr = array('Authorization: Bearer '.$accessToken);
	curl_setopt_array($ch, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $uri,
	CURLOPT_HTTPHEADER => $hdr
	));
	
	
	$data = curl_exec($ch); 
	curl_close($ch);
	
	
	$xml = new SimpleXMLElement($data);
	$id = $xml->id;
	echo $id;
	
	
	
?>