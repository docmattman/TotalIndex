<?php

// include config file
include "config.php";

// ***----- Don't change below this line unless you know what you are doing -----***** \\
 session_save_path("/home/users/web/b1814/as.sweetphp/phpsessions");
session_start();

// Process login from login.php
if($submit == "login") {
	if($uname == $username && $pw == $password) {
		$MyUsername = $username;
		$MyPassword = $password;
		$MyLogin = "true";
		session_register("MyLogin");
		session_register("MyUsername");
		session_register("MyPassword");
	}
	else {
		die("<div align=\"center\">Error:  Username and password don't match.<br /><a href='javascript:history.back()'>Try Again</a></div>"); 
	}
}


if($MyLogin != "true" || $MyUsername != $username || $MyPassword != $password) {
	include "login.php";
	die();
	//die("<div align=\"center\">Error:  You must be logged in to access this area.<br /><a href='login.php'>Go Login</a></div>"); 
}

$msg = "";

if(!empty($userfile)) { 
	// Copy extension icon to folder and delete tmp file
	$newfile = $ext.".gif";
	copy($userfile, "./icons/$newfile") or die("Can't upload file to that location"); 
	unlink($userfile);
	$msg = "New Extension Added Successfully";
	
	// Add in the new extension to the switch statement
	$filename = "functions.php";
	$temp = 'case "'.$ext.'";
		$type = "'.$dsc.'";
		$image = "'.$newfile.'";
		break;
	//--- New Here---//';
	
	$fcontents = implode('', file($filename));
	$fcontents = ereg_replace("//--- New Here---//", $temp, $fcontents);
	
	$fp = fopen($filename, "w+");
	fwrite($fp, $fcontents);
	fclose($fp);
}

echo "
<html>
<head>
<title>- Add Extension and Icon -</title>
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
    <form method=\"POST\" action=\"add.php\" enctype=\"multipart/form-data\">
    <table class=\"tbl02\">
      <tr>
        <td width=\"100%\" class=\"td01\" align=\"center\" colspan=\"2\"><p class=\"txt01\">For best results, use 16 x 16 gif files for the icons.</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\"><p class=\"txt02\">Choose the icon image file:&nbsp;&nbsp;
	  <br />
	  (must be a gif file)&nbsp;&nbsp;
	  </td>
        <td class=\"td09\" valign=\"top\"><input type=\"file\" name=\"userfile\" size=\"20\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\" valign=\"top\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\"><p class=\"txt02\">Type the extension for the file type:&nbsp;&nbsp;<br>
        &nbsp;(ex:&nbsp; pdf)&nbsp;&nbsp;</td>
        <td class=\"td09\" valign=\"top\"><input type=\"text\" name=\"ext\" size=\"5\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\" valign=\"top\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\"><p class=\"txt02\">Short file description:&nbsp;&nbsp;<br>
        (ex:&nbsp; Acrobat File)&nbsp;&nbsp;</td>
        <td class=\"td09\" valign=\"top\"><input type=\"text\" name=\"dsc\" size=\"20\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\">&nbsp;</td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\"><input type=\"submit\" name=\"submit\" value=\"add\"></td>
      </tr>
      <tr>
        <td class=\"td09\" align=\"right\">&nbsp;</td>
        <td class=\"td09\" align=\"right\"><a href='login.php?action=logout' class=\"link01\">Logout</a>&nbsp;</td>
      </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td class=\"td08\" align=\"right\" valign=\"bottom\">&nbsp;</td>
  </tr>
</table>
</body>
</html>
";

?>