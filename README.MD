Setting up SSO for Google Apps using SAML protocol.
Entire application built using JQuery for the front end and PHP for the Web Server Code.

Changes that need to be made to sample code before you can use it:

index.php - Update value for variable redirectURI (line 165)
index.php - Update value of client ID used in URL variable (line 166)
getAccessToken.php - Update value of client ID (line 3)
getAccessToken.php - Update value of client secret (line 4)
getAccessToken.php - Update the redirect URI parameter (it needs to be encoded) (line 14)
updateSSO.php - Update sign in URI, sign out URI and change password URI on lines 14, 15 & 16
