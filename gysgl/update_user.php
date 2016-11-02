<?php
session_start();
$czy = $_SESSION['admin'];

$id = intval($_REQUEST['id']);
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$zw = $_REQUEST['zw'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$bz=$_REQUEST['bz'];

include 'conn.php';

$sql = "update users_gys set firstname='$firstname',lastname='$lastname',zw='$zw',phone='$phone',email='$email',bz='$bz' where id=$id";
$result = @mysql_query($sql);

//$log //(商品编号:$spbh,商品名称:$spmc)";//
$cz = "(修改供应商)(供应商:$firstname,公司:$lastname,职位:$zw,电话:$phone,邮件:$email,备注:$bz)";
$time = date("Y/m/d H:i:s");
@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>