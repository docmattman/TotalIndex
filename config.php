<?php
//
// IMPORTANT!  If you change the variable names, this script will NOT function properly, just change the values.
//

// Set the admin username for login
//
$username = "AdminUsername";


// Set the admin password for login
//
$password = "AdminPassword";


// $HomeDir - Absolute path (not url) to TotalIndex script (usually something like: /home/user/public_html/TotalIndex/ 
// on Linux and something like: c:/inetpub/wwwroot/TotalIndex/ on Windows systems).
// Be sure to include the ending slash in the home directory
//
$HomeDir = "C:/Inetpub/wwwroot/All-Around Software/TotalIndex/2.0/files/";


// $HomeDir - URL path to the TotalIndex script (usually something like: http://yourdomain.com/TotalIndex/)
// Be sure to include the ending slash in the url path.
//
$HomeURL = "http://localhost/All-Around Software/TotalIndex/2.0/files/";


// $ThemeFolder - name of the folder that contains the theme you want (with ending slash).  The different theme folders
// are located in the "themes" folder of the script.  Just replace the default if you want a different one.
//
$ThemeFolder = "default/";


// Color of alternate rows on the index page.  The index.php file produces a list of all files and folders in a
// given directory, and it alternates the background color of the files from white, to whatever you choose as an
// alternate row color to make it easier for visitors to read the list.
//
$RowColor = "#e9e9e9";


// If $Allow_Readme is set to "1", then a directory description will appear at the top of every page if the folder
// contains a "readme.txt" file.  The page will display any text that you write in the readme.txt file at the top 
// of the page.  This is very useful if you want to give your visitors a description of the folder and it's contents 
// in the indexed page view.  If you don't want to include a readme.txt readme.txt description, then set 
// $Allow_Readme equal to zero.
//
$Allow_Readme = 1;

// If you want the script to use a different file name (instead of "readme.txt"), then change the $Readme_File to
// the name of the file you would like to use instead.
//
$Readme_File = "readme.txt";



// --- Set global exclusions --- \\
// Read below to learn how to exclude certain files, folders, and file extensions from the indexed list of files
// and folders on your site.  These files, folders, and extensions will be excluded from ALL directories that you
// are indexing.
//
// You may also add directory-specific exclusions in the index.php file when you place it in a given folder.  Doing
// this will only prevent files/folders from appearing in the index listing for THAT folder only, and not any folder
// like the global exclusions below
//  

// DO NOT delete next line
$Exclude_File = array();
//
// Listed below are two file names that are automatically excluded from the listings.  Files with these names will 
// not be listed in ANY indexed directory on your site.  If you wish to have files with these names displayed in the 
// indexed listing, you must comment or delete these exclude lines.  If you want to add more file names to be globally 
// excluded, (NOTE: these ARE case sensitive) just add another line like:
//
// $Exclude_File[] = "MY_FILE.txt";
// 
$Exclude_File[] = ".htaccess";
$Exclude_File[] = "index.php";
$Exclude_File[] = "readme.txt";


// DO NOT delete next line
$Exclude_Folder = array();
//
// Listed below is a folder name that is automatically excluded from the listings.  Folders with this name will 
// not be listed in ANY indexed directory on your site.  If you wish to have folders with these names displayed in the 
// indexed listings, you must comment or delete these exclude lines.  If you want to add more folder names to  be globally 
// excluded, just add another line like:
//
// $Exclude_Folder[] = "MY_FOLDER";
//
$Exclude_Folder[] = "Restricted";


// DO NOT delete next line
$Exclude_Extension = array();
//
// Listed below is an extension that automatically excludes ANY file with this extension from the listings.  Files with 
// these extensions will not be listed in ANY indexed directory on your site.  If you wish to have files with these
// extensions displayed in the indexed listings, you must comment or delete these exclude lines.  If you want to add more
// extensions to  be globally excluded, just add another line like:
//
// $Exclude_Extension[] = "MY_EXTENSION";
//
$Exclude_Extension[] = "hidden";

?>