<?php
session_start();
$czy = $_SESSION['admin'];

$spbh = $_REQUEST['spbh'];
$spmc = $_REQUEST['spmc'];
$spgg = $_REQUEST['spgg'];
$bzdw = $_REQUEST['bzdw'];

$scqy = $_REQUEST['scqy'];
$hwmc = $_REQUEST['hwmc'];
$ph = $_REQUEST['ph'];
$bzqz = $_REQUEST['bzqz'];

$sl = $_REQUEST['sl'];
$hsj = $_REQUEST['hsj'];
$zdsj = $_REQUEST['zdsj'];
$je = $_REQUEST['je'];

$mjph = $_REQUEST['mjph'];
$phsl = $_REQUEST['phsl'];
$bzsl = $_REQUEST['bzsl'];
$lssl = $_REQUEST['lssl'];

$cbdj = $_REQUEST['cbdj'];
$lsj = $_REQUEST['lsj'];
include 'conn.php';

$sql = "insert into table_ckkp(czy,spbh,spmc,spgg,bzdw,scqy,hwmc,ph,bzqz,sl,hsj,zdsj,je,mjph,phsl,bzsl,lssl,cbdj,lsj) values('$czy','$spbh','$spmc','$spgg','$bzdw','$scqy','$hwmc','$ph','$bzqz','$sl','$hsj','$zdsj','$je','$mjph','$phsl','$bzsl','$lssl','$cbdj','$lsj')";
@mysql_query($sql);
//$log //(商品编号:$spbh,商品名称:$spmc)";//
$cz = "(销售出库商品)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,生产企业:$scqy,货位名称:$hwmc,批号:$ph,保质期至:$bzqz,数量:$sl,含税价:$hsj,指导售价:$zdsj,金额:$je,灭菌批号:$mjph,批号数量:$phsl,包装数量:$bzsl,零散数量:$lssl,成本单价:$cbdj,零售价:$lsj)";
$time = date("Y/m/d H:i:s");
@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

echo json_encode(array(
	//'id' => mysql_insert_id(),
	'success'=> true,
	/* 'spbh' => $spbh,
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
	'lsj' => $lsj */
));

?>