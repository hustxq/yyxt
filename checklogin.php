<?php
session_start ();
require 'db/config.php';

$manager = $_POST ['manager'];
$password = sha1 ( $_POST ['password'] );

$query = mysql_query ( "SELECT * FROM easyui_admin WHERE manager='$manager' AND password='$password' LIMIT 1" ) or die ( 'SQL 错误！' );

if (! ! ($res = mysql_fetch_array ( $query, MYSQL_ASSOC ))) {
	$_SESSION ['admin'] = $manager;
	$_SESSION ['qx'] = $res ['qx'];
	$_SESSION ['qxz'] = $res ['qxz'];
	$qxz = $res ['qxz'];
	
	if ($qxz == 5) { // admin
		echo 1;
	} else {
		echo 2;
	}
	// $log
	$time = date ( "Y/m/d H:i:s" );
	@mysql_query ( "insert into table_log(czy,cz,time) values ('$manager','登录系统','$time')" );
} else {
	echo 0;
}

?>