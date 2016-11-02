<?php
session_start();
$czy = $_SESSION['admin'];
//$id = intval($_REQUEST['id']);
$ddbh = date("YmdHis").rand(10,100);

$itemid = isset($_REQUEST['itemid']) ? ($_REQUEST['itemid']) : 'spmc';
$productid = isset($_REQUEST['productid']) ? ($_REQUEST['productid']) : '';
$where = $itemid." like '%$productid%' and czy='".$czy."'";
include 'conn.php';
// where id=$id
$sql = "insert into table_cgdd_qr(ddbh,czy,spbh,spmc,spgg,bzdw,bzsl,lssl,sl,hsj,je,scqy,bz,jlgg) select '$ddbh','$czy',spbh,spmc,spgg,bzdw,bzsl,lssl,sl,hsj,je,scqy,bz,jlgg from table_cgdd where " . $where;
@mysql_query($sql);
//log
$rs=@mysql_query("select * from table_cgdd where " . $where);
while(($res = mysql_fetch_array ( $rs, MYSQL_ASSOC ))) {
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
	$cz = "(商品批量入库)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,包装数量:$bzsl,零散数量:$lssl,数量:$sl,含税价:$hsj,金额:$je,生产企业:$scqy,备注:$bz,计量规格:$jlgg)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

}

$delsql="delete from table_cgdd where " . $where;
@mysql_query($delsql);
/* 
$sql = "select * from table_cgdd czy='".$czy."'";
$rs = mysql_query("select count(*) from table_cgdd where czy = '".$czy."'");
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];
$items = array();
while($row = mysql_fetch_object($sql)){
	array_push($items, $row);
}
$result["rows"] = $items;
*/
echo json_encode(array(
		'success'=>true
));
?>