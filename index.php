<?php
//
// --- Make your customizations below.  All customizations set here will apply ONLY to this indexed directory --- \\
//
//
// $HomeDir - Absolute path (not url) to TotalIndex script (usually something like: /home/user/public_html/TotalIndex/ 
// on Linux and something like: c:/inetpub/wwwroot/TotalIndex/ on Windows systems).
// Be sure to include the ending slash in the home directory
//
$HomeDir = "c:/inetpub/wwwroot/TotalIndex v2.0/";


// Include config file - DO NOT REMOVE
include $HomeDir."config.php";


// To turn off any readme file descriptions (explained in the config.php file) just uncomment the next line (This will prevent a folder description from appearing at the top of the page)...
// $Allow_Readme = 0;


// To exclude a certain file name from the index listing, just add another line of code with the name of the file that
// you want to exclude from the list.  
//
// EXAMPLE - If you want to exclude a file named "hidden.txt", then add the following line below:
// $Exclude_File = "hidden.txt";
//
// You can add as many of these as you wish to exclude
// - This is case sensitive -
//
$Exclude_File[] = "exclude_me.txt";


// To exclude a certain folder name from the index listing, just add another line of code with the name of the folder that
// you want to exclude from the list.  
//
// EXAMPLE - If you want to exclude a folder named "hidden_folder", then add the following line below:
// $Exclude_File = "hidden_folder";
//
// You can add as many of these as you wish to exclude
// - This is case sensitive -
//
$Exclude_Folder[] = "hidden_folder";


// To exclude a files with certain extensions from the index listing, just add another line of code with the file extension that
// you want to exclude from the list.  
//
// EXAMPLE - If you want to exclude file with the extension "txt", then add the following line below:
// $Exclude_Extension = "txt";
//
// You can add as many of these as you wish to exclude
// - This is case sensitive -
//
$Exclude_Extension[] = "hide_me";


//
// ***-----  Do not change below this line -----*** \\
//

// include functions
include $HomeDir."functions.php";

//Path to themes folder with ending slash
$ThemeURL = $HomeURL."themes/";

// Path to icon folder with ending slash
$iconfolder = $HomeURL."icons/";

$_GLOBAL['image'] = "";

// Open folder directory
if(!isset($fdir)) {
	$fdir = "./";
}
$fdir = str_replace("../", "", $fdir);

// check to see if still inside directory boundry
$check = substr($fdir, 0, 2);
if($check != "./") {
	$fdir = "./";
}

// setup file properties class
class File_Properties
{
	var $file_name;		// just the file name
	var $file_ext;		// file extension
	var $file_size;		// size of file
	var $file_date;		// date modified
	var $file_icon;		// icon for file type
	var $file_type;		// short description for file type

	// constructor method - build object
	function Build($file)
	{
		$this->setFname($file);
		$this->setFext($file);
		$this->setFsize($file);
		$this->setFdate($file);
		$this->setFicon_type();
	}

	// Set file name
	function setFname($file)
	{
		$this->file_name = basename($file);
	}
	// set file extension
	function setFext($file)
	{
		$this->file_ext = array_pop(explode('.', $file));
	}
	// set file size
	function setFsize($file)
	{
		$kbs = filesize($file) / 1024;
		$this->file_size = round($kbs, 2);
	}
	// set date modified
	function setFdate($file)
	{
		$modified = filectime($file);
		$this->file_date = date("m/d/Y H:i A", $modified);
	}
	// set file type
	function setFicon_type()
	{
		list($this->file_type, $this->file_icon) = split("\?", GetExt($this->file_ext), 2);
	}

	// setup all get/return methods for class vars
	function getFname()
	{
		return $this->file_name;
	}
	function getFext()
	{
		return $this->file_ext;
	}
	function getFsize()
	{
		return $this->file_size;
	}
	function getFdate()
	{
		return $this->file_date;
	}
	function getFicon()
	{
		return $this->file_icon;
	}
	function getFtype()
	{
		return $this->file_type;
	}
}

// setup folder properties class
class Folder_Properties
{
	var $dir_name;						// just the directory name
	var $dir_date;						// date modified
	var $dir_icon = "folder.gif";		// icon for directory
	var $dir_type = "File Folder";		// short description for file type

	// constructor method - build object
	function Build($dir)
	{
		$this->setFname($dir);
		$this->setFdate($dir);
	}

	// Set file name
	function setFname($dir)
	{
		$this->dir_name = basename($dir);
	}
	// set date modified
	function setFdate($dir)
	{
		$modified = filectime($dir);
		$this->dir_date = date("m/d/Y H:i A", $modified);
	}

	// setup all get/return methods for class vars
	function getFname()
	{
		return $this->dir_name;
	}
	function getFdate()
	{
		return $this->dir_date;
	}
	function getFicon()
	{
		return $this->dir_icon;
	}
	function getFtype()
	{
		return $this->dir_type;
	}
}

// initialize file and folder arrays
$file_array = array();
$dir_array = array();
$Fname_array = array();
$Dname_array = array();

// open directory
$dir = opendir($fdir);

// Read files into array
while(false !== ($file = readdir($dir))) 
{	
	if($file != "." && $file != "..") 
	{	
		$type = filetype($fdir.$file);
		$info = pathinfo($file);
		if($type != "dir")
		{
			if(isset($info["extension"]))
			{
				$file_extension = $info["extension"];
			}
		}
		
		if($type == "dir" && !in_array($file, $Exclude_Folder)) 
		{
			// setup folder object
			$This_Dir = new Folder_Properties;
			$This_Dir->Build($fdir.$file);
			$dir_array[] = $This_Dir;
		}
		elseif($type == "file" && !in_array($file, $Exclude_File) && !in_array($file_extension, $Exclude_Extension))
		{
			// setup file object
			$This_File = new File_Properties;
			$This_File->Build($fdir.$file);
			$file_array[] = $This_File;
		}
	}
}
closedir($dir);

// Set default sort by method
if(!isset($SortBy) || $SortBy != 0 && $SortBy != 1) {
	$SortBy = 0;
}

// Number of the column to sort by (0-3) set default to 0
if(!isset($NumSort) || $NumSort != 0 && $NumSort != 1 && $NumSort != 2 && $NumSort != 3) {
	$NumSort = 0;
}

// determin object sorting methods
switch($NumSort) 
{
	case 0;
		$Fsort_method = "file_name";
		$Dsort_method = "dir_name";
	break;
	case 1;
		$Fsort_method = "file_size";
		$Dsort_method = "dir_name";
	break;
	case 2;
		$Fsort_method = "file_type";
		$Dsort_method = "dir_name";
	break;
	case 3;
		$Fsort_method = "file_date";
		$Dsort_method = "dir_date";
	break;
	default:
		$Fsort_method = "file_name";
		$Dsort_method = "dir_name";
}

// object sorting functions
function ASC_sort_file_objects($a, $b) 
{
	global $Fsort_method;
	$obj1 = strtolower($a->$Fsort_method);
	$obj2 = strtolower($b->$Fsort_method);
   	if ($obj1 == $obj2) return 0;
    return ($obj1 < $obj2) ? -1 : 1;
}
function ASC_sort_dir_objects($a, $b) 
{
	global $Dsort_method;
	$obj1 = strtolower($a->$Dsort_method);
	$obj2 = strtolower($b->$Dsort_method);
   	if ($obj1 == $obj2) return 0;
   	return ($obj1 < $obj2) ? -1 : 1;
}
function DESC_sort_file_objects($a, $b) 
{
	global $Fsort_method;
	$obj1 = strtolower($a->$Fsort_method);
	$obj2 = strtolower($b->$Fsort_method);
   	if ($obj1 == $obj2) return 0;
    return ($obj1 > $obj2) ? -1 : 1;
}
function DESC_sort_dir_objects($a, $b) 
{
	global $Dsort_method;
	$obj1 = strtolower($a->$Dsort_method);
	$obj2 = strtolower($b->$Dsort_method);
   	if ($obj1 == $obj2) return 0;
   	return ($obj1 > $obj2) ? -1 : 1;
}

// sort ascending
if($SortBy == 0) {
	// sort arrays (ASCENDING)
	usort($file_array, 'ASC_sort_file_objects');
	usort($dir_array, 'ASC_sort_dir_objects');
	
	$arrow = "&#9650;";
	$SortBy = 1;
}
// sort descending
else {
	// sort arrays (DESCENDING)
	usort($file_array, 'DESC_sort_file_objects');
	usort($dir_array, 'DESC_sort_dir_objects');
	
	$arrow = "&#9660;";
	$SortBy = 0;
}

echo "<html>
<head>
<title>TotalIndex</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"".$ThemeURL.$ThemeFolder."style.css\">

</head>
<body>
<table class='tbl01'>
";

// description file 
$desc_file = $fdir.$Readme_File;

if($Allow_Readme == 1 && file_exists($desc_file))
{
echo "
      <tr>
        <td class='td01' valign='top'>&nbsp;</td>
      </tr>
	  	<td valign=\"top\" height=\"3\" width=\"100%\"><font size=\"1\">&nbsp;</font></td>
	  </tr>
      <tr>
        <td valign=\"top\" height=\"10\" width=\"100%\">
";
	// output description
	if(file_exists($desc_file))
	{
		$handle = fopen ($desc_file, "r"); 
		$dir_desc = fread ($handle, filesize ($desc_file));
		fclose ($handle);
		$dir_desc = str_replace("\n", "<br />", $dir_desc);
		echo "<p class=\"txt02\">".$dir_desc."</p>";
	}
	
echo "</td>
      </tr>
	  </tr>
	  	<td valign=\"top\" height=\"3\" width=\"100%\"><font size=\"1\">&nbsp;</font></td>
	  </tr>
";
}

echo "
	<tr>
    <td class='td01' valign='top'>
    <div align='left'>
    <table width='100%'>
      <tr>
        <td class='td02'>&nbsp;</td>
        <td class='td03' width='23%' align='left'><a href='index.php?NumSort=0&SortBy=$SortBy&fdir=$fdir' class='link01'>Name $arrow</a></td>
        <td class='td04'>&nbsp;</td>
	  	<td class='td02'>&nbsp;</td>
        <td class='td03' width='13%' align='right'><a href='index.php?NumSort=1&SortBy=$SortBy&fdir=$fdir' class='link01'>Size</a></td>
        <td class='td04'>&nbsp;</td>
        <td class='td02'>&nbsp;</td>
        <td class='td03' width='18%' align='left'><a href='index.php?NumSort=2&SortBy=$SortBy&fdir=$fdir' class='link01'>Type</a></td>
        <td class='td04'>&nbsp;</td>
        <td class='td02'>&nbsp;</td>
        <td class='td03' width='18%' align='right'><a href='index.php?NumSort=3&SortBy=$SortBy&fdir=$fdir' class='link01'>Date Modified</a></td>
        <td class='td04'>&nbsp;</td>
        <td width='20%'>&nbsp;</td>
      </tr>
";

// directory is not the base dir
if($fdir != "./") {
	// Make every other row a color
	$othernum = 1;

	// Get folder one level up
	$UpPath = dirname($fdir)."/";
	
	echo "
	<tr>
        <td class='td05'>&nbsp;</td>
        <td class='td06' width='23%' align='left'><a href='index.php?fdir=$UpPath' class='link01'><img src='".$iconfolder."levelup.gif' border='0'> Up One Level</a></td>
        <td class='td07'>&nbsp;</td>
	  	<td class='td05'>&nbsp;</td>
        <td class='td06' width='13%'>&nbsp;</td>
        <td class='td07'>&nbsp;</td>
        <td class='td05'>&nbsp;</td>
        <td class='td06' width='18%'>&nbsp;</td>
        <td class='td07'>&nbsp;</td>
        <td class='td05'>&nbsp;</td>
        <td class='td06' width='18%'>&nbsp;</td>
        <td class='td07'>&nbsp;</td>
        <td width='20%'>&nbsp;</td>
      </tr>";
}
else {
	$othernum = 0;
}

// alternate row counter
$count = 0;

// Output folder information
for($y = 0; $y < count($dir_array); $y++)
{
	// alternate row colors
	if($count % 2 != $othernum) {
		$special = "bgcolor='$RowColor'";
	}
	else {
		$special = "";
	}
	$count++;

	echo "
	<tr>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='23%' align='left'><a href=\"index.php?SortBy=".$SortBy."&fdir=".$fdir.$dir_array[$y]->getFname()."/\" class=\"link01\"><img src=\"".$iconfolder.$dir_array[$y]->getFicon()."\" border=\"0\"> ".$dir_array[$y]->getFname()."</td>
        <td class='td07' $special>&nbsp;</td>
	  	<td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='13%' align='right'>&nbsp;</td>
        <td class='td07' $special>&nbsp;</td>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='18%' align='left'>".$dir_array[$y]->getFtype()."</td>
        <td class='td07' $special>&nbsp;</td>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='18%' align='right'>".$dir_array[$y]->getFdate()."</td>
        <td class='td07' $special>&nbsp;</td>
        <td width='20%' $special>&nbsp;</td>
      </tr>
	";
}

// output file info
for($y = 0; $y < count($file_array); $y++)
//while (list($key, $val) = each($Fname_array))
{
	// alternate row colors
	if($count % 2 != 0) {
		$special = "bgcolor='$RowColor'";
	}
	else {
		$special = "";
	}
	$count++;

	echo "
	<tr>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='23%' align='left'><a href=\"".$fdir.$file_array[$y]->getFname()."\" class=\"link01\" target=\"_blank\"><img src=\"".$iconfolder.$file_array[$y]->getFicon()."\" border=\"0\"> ".$file_array[$y]->getFname()."</td>
        <td class='td07' $special>&nbsp;</td>
	  	<td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='13%' align='right'>".$file_array[$y]->getFsize()." kb</td>
        <td class='td07' $special>&nbsp;</td>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='18%' align='left'>".$file_array[$y]->getFtype()."</td>
        <td class='td07' $special>&nbsp;</td>
        <td class='td05' $special>&nbsp;</td>
        <td class='td06' $special width='18%' align='right'>".$file_array[$y]->getFdate()."</td>
        <td class='td07' $special>&nbsp;</td>
        <td width='20%' $special>&nbsp;</td>
      </tr>
	";
}


echo "
	</table>
    </div>
    </td>
  </tr>
  <tr>
    <td width='100%'>&nbsp;</td>
  </tr>
  <tr>
    <td class=\"td01\" valin=\"bottom\" align=\"center\"><p class=\"txt02\">Powered By:  <a class=\"link01\"  href=\"http://sweetphp.com/projects/TotalIndex/index.php?v=TI2.0\"><b>TotalIndex</b></a></p></td>
  </tr>
</table>
</body>
</html>
";
?>