<?php
	
	$domain = $_GET['domain'];
	$accessToken = $_GET['accessToken'];
	$ID = $_GET['ID'];
	
	$input_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	$input_xml .= "<atom:entry xmlns:atom='http://www.w3.org/2005/Atom' xmlns:apps='http://schemas.google.com/apps/2006'>
<atom:id>";
$input_xml .= $ID;
$input_xml .= "
</atom:id>
<apps:property name='enableSSO' value='true'/>
<apps:property name='samlSignonUri' value='LOGINURI'/>
<apps:property name='samlLogoutUri' value='LOGOUTURI'/>
<apps:property name='changePasswordUri' value='CHANGEPASSWORDURI'/>
<apps:property name='ssoWhitelist' value=''/>
<apps:property name='useDomainSpecificIssuer' value='true'/>
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
