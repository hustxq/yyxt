<?php
date_default_timezone_set('PRC');
$conn = @mysql_connect('127.0.0.1','root','mysql');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('easyui', $conn);

?>