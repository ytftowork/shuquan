<?php
	$dbhost="localhost";
	$dbname="shuquan";
	//$dbuser="root";
	// $dbpassword="";
	$dbuser="haitou";
	$dbpassword="supernadc";
	$conn=mysqli_connect($dbhost,$dbuser,$dbpassword) or die();
	mysqli_select_db($conn,$dbname) or die("dberror");
	mysqli_query($conn,"SET NAMES 'UTF8'");
	// error_reporting(0);
?>
<?php
	@set_time_limit(0); //0为无限制时间
	date_default_timezone_set ('Asia/Shanghai');
?>