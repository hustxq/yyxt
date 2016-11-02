<?php
session_start();
$czy = $_SESSION['admin'];
$id = intval($_REQUEST['id']);

include 'conn.php';
$rs=@mysql_query("select * from table_ckkp where id=$id");
if (! ! ($res = mysql_fetch_array ( $rs, MYSQL_ASSOC ))) {
	//$log //(商品编号:$spbh,商品名称:$spmc)";//
	$spbh = $res['spbh'];
	$spmc = $res['spmc'];
	$spgg = $res['spgg'];
	$bzdw = $res['bzdw'];

	$scqy = $res['scqy'];
	$hwmc = $res['hwmc'];
	$ph = $res['ph'];
	$bzqz = $res['bzqz'];

	$sl = $res['sl'];
	$hsj = $res['hsj'];
	$zdsj = $res['zdsj'];
	$je = $res['je'];
	
	$mjph = $res['mjph'];
	$phsl = $res['phsl'];
	$bzsl = $res['bzsl'];
	$lssl = $res['lssl'];
	
	$cbdj = $res['cbdj'];
	$lsj = $res['lsj'];
	$cz = "(删除将销售商品)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,生产企业:$scqy,货位名称:$hwmc,批号:$ph,保质期至:$bzqz,数量:$sl,含税价:$hsj,指导售价:$zdsj,金额:$je,灭菌批号:$mjph,批号数量:$phsl,包装数量:$bzsl,零散数量:$lssl,成本单价:$cbdj,零售价:$lsj)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

}

$sql = "delete from table_ckkp where id=$id";
@mysql_query($sql);


echo json_encode(array(
		'success'=>true,
		'spbh' => $spbh,
		'spmc' => $spmc,
		'spgg' => $spgg,
		'bzdw' => $bzdw,
			
		'scqy' => $scqy,
		'hwmc' => $hwmc,
		'ph' => $ph,
		'bzqz' => $bzqz,
		
		'sl' => $sl,
		'hsj' => $hsj,
		'zdsj' => $zdsj,
		'je' => $je,
			
		'mjph' => $mjph,
		'phsl' => $phsl,
		'bzsl' => $bzsl,
		'lssl' => $lssl,
			
		'cbdj' => $cbdj,
		'lsj' => $lsj
));
/* echo json_encode(array(
		's'=>true
)); */
?>