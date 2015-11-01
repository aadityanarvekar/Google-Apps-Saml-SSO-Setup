#	Google Apps SAML SSO Setup
The process for setting up SSO (single sign on) for Google Apps involves the following high level steps:

*	Create project on [Google Developer Console](https://console.developers.google.com/project) – 
*	Creates a client ID and a client secret
*	Procure Authorization Code
*	Procure Access Token
*	Retrieve current SSO Settings
*	Update SSO Settings

Application built using Bootstrap for the front end and PHP for the Server code.
Entire code has been uploaded to the following GitHub repository:
https://github.com/aadityanarvekar/Google-Apps-Saml-SSO-Setup/

Changes that need to be made to sample code before you can use it:

*	index.php – Update value for variable `redirectURI` (line 165)
*	index.php – Update value of `client ID` used in URL variable (line 166)
*	getAccessToken.php – Update value of `client ID` (line 3)
*	getAccessToken.php – Update value of `client secret` (line 4)
*	getAccessToken.php – Update value of `redirectUri` (line 6)
*	updateSSO.php – Update `sign in URI, sign out URI` and `change password` URI on lines 9, 10 & 11
*	updateSSO.php – Change seetings of XML body of PUT request as per your requirements (line 7-14)
