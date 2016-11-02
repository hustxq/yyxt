<?php

$firstname = $_REQUEST['manager'];
$lastname = isset($_REQUEST['password'])?sha1($_REQUEST['password']):'';
$zw =isset($_REQUEST['qxz'])?intval($_REQUEST['qxz']):4;
if($zw==4){
	$qx="业务员";
}else {
	$qx="管理员";
}

include 'conn.php';

$sql = "insert into easyui_admin(manager,password,qxz,qx) values('$firstname','$lastname',$zw,'$qx')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>