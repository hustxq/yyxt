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
$sql = "insert into table_shth_qr(ckbh,czy,spbh,spmc,spgg,bzdw,scqy,hwmc,ph,bzqz,sl,hsj,zdsj,je,mjph,phsl,bzsl,lssl,cbdj,lsj) select '$ddbh','$czy',spbh,spmc,spgg,bzdw,scqy,hwmc,ph,bzqz,sl,hsj,zdsj,je,mjph,phsl,bzsl,lssl,cbdj,lsj from table_ckkp where " . $where;
@mysql_query($sql);

//log
$rs=@mysql_query("select * from table_shth where " . $where);
while(($res = mysql_fetch_array ( $rs, MYSQL_ASSOC ))) {
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
	$cz = "(退回商品批量确认)(商品编号:$spbh,商品名称:$spmc,商品规格:$spgg,包装单位:$bzdw,生产企业:$scqy,货位名称:$hwmc,批号:$ph,保质期至:$bzqz,数量:$sl,含税价:$hsj,指导售价:$zdsj,金额:$je,灭菌批号:$mjph,批号数量:$phsl,包装数量:$bzsl,零散数量:$lssl,成本单价:$cbdj,零售价:$lsj)";
	$time = date("Y/m/d H:i:s");
	@mysql_query("insert into table_log(czy,cz,time) values ('$czy','$cz','$time')");

}
/* $select_sl = "";
$rs = mysql_query("select sl from table_cgdd_qr where czy = '".$czy."'");
*/
$delsql="delete from table_shth where " . $where;
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