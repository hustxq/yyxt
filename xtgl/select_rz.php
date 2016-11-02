<?php
	
include 'conn.php';
session_start();
$czy = $_SESSION['admin'];
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
//"firstname";//
$itemid = isset($_POST['itemid']) ? mysql_real_escape_string($_POST['itemid']) : 'czy';
$productid = isset($_POST['productid']) ? mysql_real_escape_string($_POST['productid']) : '';

$offset = ($page-1)*$rows;

$result = array();
//itemid like '$itemid%' and
if($itemid=='czy'){
$where = $itemid." like '%$productid%' order by time desc ";// and czy='".$czy."'
}else{
	$time = date("Y/m/d H:i:s");
	$where = "time between '".$productid."' and '".$time."' order by time";
}
$rs = mysql_query("select count(*) from table_log where " . $where);
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];

$rs = mysql_query("select * from table_log where " . $where . " limit $offset,$rows");

$items = array();
while($row = mysql_fetch_object($rs)){
	array_push($items, $row);
}
$result["rows"] = $items;

echo json_encode($result);
	
?>