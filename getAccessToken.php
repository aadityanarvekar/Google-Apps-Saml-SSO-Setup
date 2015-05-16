<?php

	$clientID = "451274390469-ttotrev9ve7b21md9njb9vj1iqlmic5c.apps.googleusercontent.com";
	$clientSecret = "cmgCMqWEyyLU3OoOzSCOM4Yk";
	$domainEndPoint = "https://google.com/a/";

	$domain = $_GET['userDomain'];
	$authCode = $_GET['code'];
	//echo "Domain: ".$domain."<br />";
	//echo "Authorization Code: ".$authCode;
			
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"https://www.googleapis.com/oauth2/v3/token");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&code=".$authCode."&client_id=".$clientID."&client_secret=".$clientSecret."&redirect_uri=http%3A%2F%2Fwww.aadityanarvekar.com%2FGoogleApps%2Findex.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	$json = json_decode($response, true);
	
	if ($json['error'] != "") {
		$error = $json['error_description'];
		echo "Error: ".$error;
	} else {
		$accessToken = $json['access_token'];
		echo $accessToken;
	}
	
	
	curl_close ($ch);
	
	
	
	/*
	
	SSO
	https://apps-apis.google.com/a/feeds/domain/2.0/{domainName}/sso/general
	
	https://accounts.google.com/o/oauth2/auth?scope=https://apps-apis.google.com/a/feeds/domain/&response_type=code&redirect_uri=http%3A%2F%2Fwww.aadityanarvekar.com%2FGoogleApps%2FgetAccessToken.php&state=TEST_ACCESS_REQUEST&client_id=451274390469-ttotrev9ve7b21md9njb9vj1iqlmic5c.apps.googleusercontent.com&hl=en&from_login=1&as=-4a842f211702b211&pli=1&authuser=0
	
	, false, $context
	
	
	$options = array(
	    'http' => array(
	        'header'  => "Content-Type: application/x-www-form-urlencoded",
	        'method'  => 'POST',
	        'content' => http_build_query($data),
	    ),
	);
	
	https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2Fwww.aadityanarvekar.com%2F&scope=https%3A%2F%2Fapps-apis.google.com%2Fa%2Ffeeds%2Fdomain%2F&state=TEST_ACCESS_REQUEST&client_id=451274390469-ttotrev9ve7b21md9njb9vj1iqlmic5c.apps.googleusercontent.com
	
	Redirect:
	http://www.aadityanarvekar.com/GoogleApps/getAccessToken.php?state=TEST_ACCESS_REQUEST&code=4/cDOGqbSrp9_bVo5u9bEk7o0PP-GZOGffMQ4gA2tNeOI.AuuBw34x-0weJvIeHux6iLa1gf9emgI#
	
4/H5WHG5t9XdqIUe3CX6ajpyXp4vmvhqNDLMV3C1gD1oc.4j7n9Pfg1OAUgtL038sCVntZvmCImgI
	
	http://www.aadityanarvekar.com/GoogleApps/getAccessToken.php?code=4/H5WHG5t9XdqIUe3CX6ajpyXp4vmvhqNDLMV3C1gD1oc.4j7n9Pfg1OAUgtL038sCVntZvmCImgI&userDomain=TESTDOMAIN
	
		
	*/
?>