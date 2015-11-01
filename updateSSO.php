<?php
	
	$domain = $_GET['domain'];
	$accessToken = $_GET['accessToken'];
	$ID = $_GET['ID'];
	
	$input_xml = "<atom:entry xmlns:atom='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>
	<apps:property name='enableSSO' value='false' />
	<apps:property name='samlSignonUri' value='http://www.example.com/sso/signon' />
	<apps:property name='samlLogoutUri' value='http://www.example.com/sso/logout' />
	<apps:property name='changePasswordUri' value='http://www.example.com/sso/changepassword' />
	<apps:property name='ssoWhitelist' value='127.0.0.1/32' />
	<apps:property name='useDomainSpecificIssuer' value='false'/>
	</atom:entry>";
	
	
	$uri = "https://apps-apis.google.com/a/feeds/domain/2.0/".$domain."/sso/general";
	
	
	$ch2 = curl_init(); 
	curl_setopt($ch2, CURLOPT_URL, $uri);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/atom+xml',
	'Authorization: Bearer '.$accessToken));	
	curl_setopt($ch2, CURLOPT_HEADER, false);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, $input_xml);
	
	
	$response = curl_exec($ch2); 
	curl_close($ch2);
	
	echo "<br />".$response;
	
?>
