-----------------------------------------------------------------
 TotalIndex v2.0 script by Matt Palermo
-----------------------------------------------------------------
 Copyright 2003 TotalIndex v2.0, All rights reserved.
-----------------------------------------------------------------
 This script is free of charge.  If you like what you see, 
 please visit http://www.totaldev.com for more available scripts.
 Allow, please feel free to link to my site, and I will link 
 back to yours.
-----------------------------------------------------------------
TotalIndex v2.0 is a script that is designed to replace the
simple, and boring default index page of a site which lists the
files in an indexed folder.  This script produces a stylish and 
organized view of the files and folders in an indexed directory.
Any folder on you site (including subfolders) can easily be
indexed simply by copying a single file to the highest level folder.  
This script comes with many icons for different file types as well 
as the ability to easily let the admin add custom icons and file
type extensions to the system.  TotalIndex comes with many preset
style themes to choose from.  The script can be installed 
anywhere on your server and DOESN'T require the use of a database.


--- Installation ---
To install TotalIndex v2.0 on your website:

1.	Open the config.php file and setup the admin username and
	password.  This will allow only an admin to add file
	extensions to the indexing system.
  
2.	While in the config.php file, input your webservers adsolute
	path and url to the TotalIndex source files.  See config file
	for more detailed descriptions for these paths.  Be sure to 
	include the slash after each path.  IMPORTANT! The absolute 
	path must also be set in the index.php file as well.

3.	Still in the config.php file, set the folder for your favorite
	style theme.  The different style theme folders are located in
	the "themes" folder of the TotalIndex script.  Just enter the 
	folder name of your favorite theme and include the slash after 
	after the folder name.

4.	In the last part of the config.php file, set the alternating row
	color for the index file listing page and any other special
	options you wish to set for the script.  See config file for a 
	more detailed description.

5.	Upload all files to your webserver into the directory you 
	specified in the config.php file.  You must use the same folder
	you set in the config file, or the script will NOT work.

6.	Set permissions to the icons folder and the functions.php file:
	chmod "icons" folder to 777
	chmod "functions.php" file to 777
	These must be set to 777 to allow reading and writing	privaledges
	for adding file extensions to the TotalIndex system.

7.	Copy the index.php file and place the copy inside ANY folder of your
	webserver that you want to index with this system.  The folder DOES NOT 
	have to be a subdirectory of the TotalIndex script.  Any folder on your
	webserver may be indexed simply by placing a copy of the index.php file 
	inside it.



--- Customization ---
TotalIndex v2.0 includes support and icons for many different file types.  However,
you may easily add a file type, with an icon that is not already in the system.
All you need to do is go to the login.php page for your TotalIndex script and login
with the admin username and password you setup earlier.  Then proceed to add your file
extension to the system by uploading an icon for it then set the name for it.  NOTE! You
must use a .gif file as the icon and use an icon with pixel dimensions: 16 x 16 to produce
the best results.  Once you do this, the icon and file type will be matched up and added
into the indexing system.


--- Special Features ---

- Stylish and organized listing of files and folders.

- Ability to easily exclude files/folders/extensions from index list

- A folder description file can be set to display any info about the current folder.

- Easy to use Administration Area.

- Choice of many different style themes to customize it to your site.

- Support for many file type extensions and the ability to add your own
  custom extensions with icons that are not included.




Copyright 2003 TotalIndex v2.0, All rights reserved.
