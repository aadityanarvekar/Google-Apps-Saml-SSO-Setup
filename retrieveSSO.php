<?php
	
	$accessToken = $_GET['accessToken'];
	$domain = $_GET['domain'];
	//echo "Access Token: ".$accessToken."<br /><br />";
	
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
	
	//header('Content-Type:  application/xml');
	//echo $data;
	
	$xml = new SimpleXMLElement($data);
	$id = $xml->id;
	echo $id;

	
	
	/*
	http://www.aadityanarvekar.com/GoogleApps/retrieveSSO.php?domain=devmicrostrategy.com&accessToken=ya29.cwEftzuaA5yqGrq01AAqLK4-CL8nzJsn1yxngDLjKjOwvWJT-KW1h2lUt3kvlghGbgzrJd9E0Cne3A
	
	
	Access Token:   ya29.cwHUqWvDdK05bR-mxkCW20aHffQeZoUoYkFvpDv_53y91ayGqQtvdfshYpuAkB1Tn8XSefwkuLwJjg

	
curl -H "Authorization: Bearer  ya29.cwHttTIy5_Ah18O8s1fI9HqQdA1XW_InWbnKBt1Ou997mt3XNHKTziWCsyIIC4cxM5mJTaKVNoPCJQ" https://apps-apis.google.com/a/feeds/domain/2.0/devmicrostrategy.com/sso/general
	
	*/
	
?>