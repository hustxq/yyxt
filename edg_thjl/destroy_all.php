<?php
$czy = "admin";
//$id = intval($_REQUEST['id']);
$ddbh = date("YmdHis").rand(10,100);
include 'conn.php';
// where id=$id
$sql = "insert into table_shth_qr(ddbh,czy,spbh,spmc,spgg,bzdw,bzsl,lssl,sl,hsj,je,scqy,bz,jlgg) select '$ddbh','$czy',spbh,spmc,spgg,bzdw,bzsl,lssl,sl,hsj,je,scqy,bz,jlgg from table_cgdd where czy='".$czy."'";
@mysql_query($sql);

$delsql="delete from table_shth where czy='".$czy."'";
@mysql_query($delsql);
/* 
$sql = "select * from table_cgdd czy='".$czy."'";
$rs = mysql_query("select count(*) from table_cgdd czy = '".$czy."'");
$row = mysql_fetch_row($rs);
$result["total"] = $row[0];
$items = array();
while($row = mysql_fetch_object($sql)){
	array_push($items, $row);
}
$result["rows"] = $items; */

echo json_encode($result);
?>