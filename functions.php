<?php

// set all GET/POST vars
if($HTTP_GET_VARS) 
{ 
	foreach($HTTP_GET_VARS as $key => $val) 
	{ 
		$$key = $val;
	}
}
// Get all vars from the POST method.  Assign variable and value
if($HTTP_POST_VARS) 
{ 
	foreach($HTTP_POST_VARS as $key => $val) 
	{ 
		$$key = $val;
	}
}

// get file extension
function GetExt($val) {
	//global $image;
	$val = strtolower($val);
	switch($val) {
	case "avi";
		$type = "Video File";
		$image = "movie.gif";
		break;
	case "bat";
		$type = "Batch File";
		$image = "batch.gif";
		break;
	case "css";
		$type = "Cascading Style Sheet";
		$image = "text.gif";
		break;
	case "exe";
		$type = "Executable File";
		$image = "exe.gif";
		break;
	case "fla";
		$type = "Flash File";
		$image = "flash.gif";
		break;
	case "gif";
		$type = "GIF Image";
		$image = "image.gif";
		break;
	case "html";
		$type = "HTML File";
		$image = "web.gif";
		break;
	case "htm";
		$type = "HTM File";
		$image = "web.gif";
		break;
	case "jpg";
		$type = "JPEG Image";
		$image = "image.gif";
		break;
	case "mp3";
		$type = "Music File";
		$image = "music.gif";
		break;
	case "msg";
		$type = "Email Message";
		$image = "email.gif";
		break;
	case "pdf";
		$type = "PDF Acrobat File";
		$image = "pdf.gif";
		break;
	case "psd";
		$type = "Photoshop File";
		$image = "psd.gif";
		break;
	case "php";
		$type = "PHP File";
		$image = "text.gif";
		break;
	case "ppt";
		$type = "PowerPoint Presentation";
		$image = "ppt.gif";
		break;
	case "swf";
		$type = "SWF Flash File";
		$image = "swf.gif";
		break;
	case "txt";
		$type = "Text Document";
		$image = "text.gif";
		break;
	case "wma";
		$type = "Windows Media Audio";
		$image = "music.gif";
		break;
	case "xls";
		$type = "Excel File";
		$image = "xls.gif";
		break;
	case "zip";
		$type = "Zip File";
		$image = "zip.gif";
		break;
	//--- New Here---//
	default:
		$type = "Unknown Type";
		$image = "unknown.gif";
	}
	// return both values (to be split)
	return $type."?".$image;
}

?>