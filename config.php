<?php 
//Your Database Name
$dbname="library";
//Your Database Username
$kname="talha";
//Your Database Password
$pass="";try{$db = new PDO("mysql:host=localhost;dbname=$dbname",$kname,$pass);$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}catch(PDOException $hata){$hata->getMessage();}?>