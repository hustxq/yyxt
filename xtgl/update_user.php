<?php

$id = intval($_REQUEST['id']);
$firstname = $_REQUEST['manager'];
$lastname = sha1($_REQUEST['password']);
$zw = $_REQUEST['qxz'];
if($zw==5){
	$qx = "管理员";
}else {
	$qx = "业务员";
}
include 'conn.php';

$sql = "update easyui_admin set manager='$firstname',password='$lastname',qxz=$zw ,qx='$qx' where id=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>