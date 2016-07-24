<?php
mysql_connect("localhost", "geekbin_project", "password") 
    or die("Could not connect to the database."); 

mysql_select_db("geekbin_mmproject") 
    or die ("Could not select database.". mysql_error);
?>