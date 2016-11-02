<?php
session_start();
$czy = $_SESSION['admin'];
$id = intval($_REQUEST['id']);

include 'conn.php';
$rs=@mysql_query("select * from table_cgdd_qr where id=$id");
if (! ! ($res = mysql_fetch_array ( $rs, MYSQL_ASSOC ))) {
	//$log //(商品编号:$spbh,商品名称:$spmc)";//
	$spbh = $res['spbh'];
	$spmc = $res['spmc'];
	$spgg = $res['spgg'];
	$bzdw = $res['bzdw'];

	$bzsl = $res['bzsl'];
	$lssl = $res['lssl'];
	$sl = $res['sl'];
	$hsj = $res['hsj'];

	$je = $res['je'];
	$scqy = $res['scqy'];
	$bz = $res['bz'];
	$jlgg = $res['jlgg'];
	$cz = "(删除库存)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,包装数量:$bzsl,零散数量:$lssl,数量:$sl,含税价:$hsj,金额:$je,生产企业:$scqy,备注:$bz,计量规格:$jlgg)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

}
$sql = "delete from table_cgdd_qr where id=$id";
@mysql_query($sql);
/* echo json_encode(array(
		'success'=>true,
		'spbh' => $spbh,
		'spmc' => $spmc,
		'spgg' => $spgg,
		'bzdw' => $bzdw,
		
		'bzsl' => $bzsl,
		'lssl' => $lssl,
		'sl' => $sl,
		'hsj' => $hsj,
		
		'je' => $je,
		'scqy' => $scqy,
		'bz' => $bz,
		'jlgg' => $jlgg
)); */
echo json_encode(array(
		'success'=>true
));
?>