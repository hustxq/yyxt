<?php
session_start();
$czy = $_SESSION['admin'];
$id = intval($_REQUEST['id']);

include 'conn.php';
$rs=@mysql_query("select * from users where id=$id");
if (! ! ($res = mysql_fetch_array ( $rs, MYSQL_ASSOC ))) {
	//$log //(商品编号:$spbh,商品名称:$spmc)";//
	$firstname = $res['firstname'];
	$lastname = $res['lastname'];
	$zw = $res['zw'];
	$phone = $res['phone'];

	$email = $res['email'];
	$bz = $res['bz'];
	
	$cz = "(删除客户)(姓名:$firstname,公司:$lastname,职位:$zw,电话:$phone,邮件:$email,备注:$bz)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

}
$sql = "delete from users where id=$id";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>