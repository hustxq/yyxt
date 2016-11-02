<?php
session_start();
$czy = $_SESSION['admin'];

$spbh = $_REQUEST['spbh'];
$spmc = $_REQUEST['spmc'];
$spgg = $_REQUEST['spgg'];
$bzdw = $_REQUEST['bzdw'];

$bzsl = $_REQUEST['bzsl'];
$lssl = $_REQUEST['lssl'];
$sl = $_REQUEST['sl'];
$hsj = $_REQUEST['hsj'];

$je = $_REQUEST['je'];
$scqy = $_REQUEST['scqy'];
$bz = $_REQUEST['bz'];
$jlgg = $_REQUEST['jlgg'];

include 'conn.php';

$sql = "insert into table_cgdd(czy,spbh,spmc,spgg,bzdw,bzsl,lssl,sl,hsj,je,scqy,bz,jlgg) values('$czy','$spbh','$spmc','$spgg','$bzdw','$bzsl','$lssl','$sl','$hsj','$je','$scqy','$bz','$jlgg')";
@mysql_query($sql);
//$log //(商品编号:$spbh,商品名称:$spmc)";//
$cz = "(新增商品)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,包装数量:$bzsl,零散数量:$lssl,数量:$sl,含税价:$hsj,金额:$je,生产企业:$scqy,备注:$bz,计量规格:$jlgg)";
$time = date("Y/m/d H:i:s");
@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");
echo json_encode(array(
	//'id' => mysql_insert_id(),
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
));

?>