<?php

	$clientID = "CLIENT_ID_PROCURED_FROM_GOOGLE_DEV_CONSOLE";
	$clientSecret = "CLIENT_SECRET_PROCURED_FROM_GOOGLE_DEV_CONSOLE";
	$domainEndPoint = "https://google.com/a/";
	$redirectUri = 'http://'.$_SERVER['HTTP_HOST'].'/Google-Apps-Saml-SSO-Setup/index.php')

	$domain = $_GET['userDomain'];
	$authCode = $_GET['code'];
			
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"https://www.googleapis.com/oauth2/v3/token");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=authorization_code&code=".$authCode."&client_id=".$clientID."&client_secret=".$clientSecret."&redirect_uri=".$redirectUri.");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	$json = json_decode($response, true);
	
	if (isset($json['error']) && $json['error'] != "") {
		$error = $json['error_description'];
		echo "Error: ".$error;
	} else {
		$accessToken = $json['access_token'];
		echo $accessToken;
	}
	
	
	curl_close ($ch);
	
?>