<!doctype html>
<html>
<head>
    <title>Google SAML SSO Setup</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     
	<link href="../resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="../resources/css/bootstrap-theme.min.css" rel="stylesheet">
	 
    <script type = "text/javascript" src = "../resources/jquery_production.js">
	</script>
    <script type = "text/javascript" src = "../resources/js/bootstrap.min.js">
	</script> 
	
	<style type = "text/css">
	
	html, body {
		height: 100%;
	}
		
		.container {
			background-image: url("images/City2.jpg");
			background-size: cover;
			background-position:center;
			width: 100%;
			height: 100%;
		}
		
		h1 {
			text-align:center;
			margin-bottom: 20px;
		}
		
		form {
			text-align: center;
		}
		
		.btn-lg {
			font-size: 1.5em;
			width: 250px;
		}
		
		#cityInput {
			height: 3em;
			font-size: 1.1em;
		}
		
		.alert-danger {
			display: none;
			margin-bottom: 10px;
			text-align: center;
		}
		
		#baseURL {
			font-weight: bold;
			float:left;
		}
		
		#authorizationCode {
			display: none;
		}
		
		.whiteBackground {
			background-color: white;
			border-radius: 25px;
		}
		
		#domainInput {
			display: none;
		}
		
		#configureSAMLSSO {
			margin-top: 10px;
			display: none;
		}
		
		#authorize {
			margin-bottom: 10px;
		}
		
		#displayAccessToken {
			margin-bottom: 10px;
		}
		
	</style>
        
</head>

<body>
	<div class = "container">
		<div class = "row">
			<div class = "col-md-6 col-md-offset-3 whiteBackground">
				
				<h1>Google Apps Set up</h1>
				<br /><br />
				<p class = "lead" id = "instructions">
					Click on the button to authorize this Web Application
				</p>
				<br />
				
				<div id = "displayAccessToken" class = "alert alert-danger">Token:</div>
				<div id = "invalidEntry" class = "alert alert-danger">Please enter a valid domain!</div>
				
				<form id = "submitDomainForm" method = "post">
					
					
					<button type="submit" id = "authorize" class="btn btn-primary btn-lg" name = "submitValue" value = "Authorize" onclick="buttonID = 0;">Authorize</button>
					
				
					    <input type="text" class="form-control" id="domainInput" name = "userEnteredDomain" placeholder="Domain" value = "devmicrostrategy.com" />
					  <br />
					   <div id = "authorizationCode" class = "alert alert-success">"<?php echo $_GET['code'];?>"</div>
					  <button type="submit" id = "configureSAMLSSO" class="btn btn-primary btn-lg" name = "submitValue" value = "configure" onclick="buttonID = 1;">Configure SSO</button>
					 
				</form>
				<br />
				
			
			
			</div>
		</div>
	</div>
	
	
	<script type = "text/javascript">
	
		var userEnteredDomain = "";
		var correctedDomain = "";
		
		if (typeof jQuery != "undefined") {
		} else {
			alert("jQuery not running!");
		}
		
		//Set top margin for h1
		repositionwhiteBackground();
		
		$(window).resize(function() {
			repositionwhiteBackground();
		});
		
		function repositionwhiteBackground() {
			$(".whiteBackground").css("margin-top", $(window).height()/4);
		}
				
		var authCode = $("#authorizationCode").html().replace(/"/g, '');
		console.log("Auth Code: "+authCode);
		
		if (authCode != "") {
			// $("#authorize").toggleClass("disabled");
			$("#authorize").css("display", "none");
			$("#domainInput").fadeIn(1000);
			$("#instructions").html("Enter user domain and click on button to Configure SSO.");
			$("#configureSAMLSSO").fadeIn(1000);
			$("#authorize").fadeOut(1000);
		}
		
		$("#submitDomainForm").submit(function(event) {
			event.preventDefault();
			
			if (buttonID == 0) {
					var redirectURI = "http://www.aadityanarvekar.com/GoogleApps/index.php";
					var URL = "https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri="+encodeURIComponent(redirectURI)+"&scope=https%3A%2F%2Fapps-apis.google.com%2Fa%2Ffeeds%2Fdomain%2F&state=TEST_ACCESS_REQUEST&client_id=451274390469-ttotrev9ve7b21md9njb9vj1iqlmic5c.apps.googleusercontent.com";
			
					window.location = URL;
			
				
			}	else {
				event.preventDefault();
				console.log("Authorization Code: "+authCode);
				
				var userEnteredDomain = $("#domainInput").val();
				var accessToken;
				var xmlID;
				if (userEnteredDomain == "") {
					event.preventDefault();
					$("#invalidEntry").css("display", "block");
					$("#displayPostCode").css("display", "none");
				} else {
					console.log("Domain: "+userEnteredDomain);
					$.get("getAccessToken.php?code="+authCode+"&userDomain="+userEnteredDomain).done(function(data) {
						if (data) {
							console.log("Token"+data);
							accessToken = data;
							//$("#displayAccessToken").html("Access Token: "+data);
							$("#configureSAMLSSO").attr("disabled", "disabled");
							$.get("retrieveSSO.php?accessToken="+data+"&domain="+userEnteredDomain).done(function(newdata) {
								console.log("Response from SSO Page: "+newdata);
								xmlID = newdata;
								console.log("New Data: "+newdata);
								
								$("#displayAccessToken").html("Access Token: "+accessToken);
								$("#displayAccessToken").append("\nID: "+xmlID);
								$("#displayAccessToken").fadeIn();
								
							})
						}
						
				});
				

			}
				
		}		

					
		});
		
		
		$("#domainInput").keyup(function() {
			if ($(this).val() != "") {
				$(".alert-danger").fadeOut(1250);
				userEnteredDomain = $("#domainInput").val();
				correctedDomain = "https://google.com/a/"+userEnteredDomain;
			}
		});
		
		
		
	</script>
	
</body>
</html>