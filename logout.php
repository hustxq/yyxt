<?php
	session_start();
	include 'db/config.php';
	//$log //(商品编号:$spbh,商品名称:$spmc)";//
	$czy = $_SESSION['admin'];
	$cz = "(退出系统)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");
	
	session_destroy();
	header('location:index.php');
?>