<?php
// include config file
include "config.php";

// ***----- Don't change below this line, unless you know what you are doing -----*** \\
// Start Session
 session_save_path("/home/users/web/b1814/as.sweetphp/phpsessions");
session_start();

if($action == "logout") {
	session_unregister("MyLogin");
	session_unregister("MyUsername");
	session_unregister("MyPassword");
	session_destroy();
	die("<div align=\"center\">Logout Successful:  Go <a href='login.php'>HERE</a> to log back in.</div>");
}

echo "
<html>
<head>
<title>- Login -</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/".$ThemeFolder."style.css\">
</head>

<body class=\"body01\">
<table class=\"tbl01\">
  <tr>
    <td class=\"td08\" valign=\"top\">&nbsp;</td>
  </tr>
  <tr>
    <td width=\"100%\" align=\"center\" valign=\"middle\">
    <br />
    <p class=\"txt01\">".$msg."</p>
    <form method=\"POST\" action=\"add.php\">
    <table class=\"tbl02\">
      <tr>
        <td width=\"100%\" class=\"td01\" align=\"center\" colspan=\"2\"><p class=\"txt01\">Login to add file extensions and icons to the system.</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\"><p class=\"txt02\">Username:&nbsp;&nbsp;</td>
        <td class=\"td09\" valign=\"top\"><input type=\"text\" name=\"uname\" size=\"20\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\"><p class=\"txt02\">Password:&nbsp;&nbsp;</td>
        <td class=\"td09\" valign=\"top\"><input type=\"password\" name=\"pw\" size=\"20\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\"><input type=\"submit\" name=\"submit\" value=\"login\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\">&nbsp;</td>
      </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td class=\"td08\" valign=\"bottom\">&nbsp;</td>
  </tr>
</table>
</body>
</html>
";

?>