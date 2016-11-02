<?php
session_start();
$czy = $_SESSION['admin'];

$firstname = $_REQUEST['firstname'];
$lastname = isset($_REQUEST['lastname'])?$_REQUEST['lastname']:'';
$zw =isset($_REQUEST['zw'])?$_REQUEST['zw']:'';
$phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
$bz = isset($_REQUEST['bz'])?$_REQUEST['bz']:'';

include 'conn.php';

$sql = "insert into users_gys(firstname,lastname,zw,phone,email,bz) values('$firstname','$lastname','$zw','$phone','$email','$bz')";
$result = @mysql_query($sql);
//$log //(商品编号:$spbh,商品名称:$spmc)";//
$cz = "(新增供应商)(供应商:$firstname,公司:$lastname,职位:$zw,电话:$phone,邮件:$email,备注:$bz)";
$time = date("Y/m/d H:i:s");
@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>