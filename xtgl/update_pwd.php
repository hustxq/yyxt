<?php
session_start ();
$man = $_SESSION ['admin'];
// $id = intval($_REQUEST['id']);
$ymm = sha1 ( $_REQUEST ['ymm'] );
$lastname = sha1 ( $_REQUEST ['xmm'] );
// $zw = $_REQUEST['qx'];

include 'conn.php';
$sql_select = "select count(*) from easyui_admin where manager='$man' and password='$ymm'";
$pwd = @mysql_query ( $sql_select );
$row = mysql_fetch_row ( $pwd );
if ($row [0] > 0) {
	$sql = "update easyui_admin set password='$lastname' where manager='$man'";
	$result = @mysql_query ( $sql );
	if ($result) {
		echo json_encode ( array (
				'success' => true 
		) );
	} else {
		echo json_encode ( array (
				'msg' => 'Some errors occured.' 
		) );
	}
} else {
	echo json_encode ( array (
			'msg' => '原密码不对,请核对.' 
	) );
}
?>