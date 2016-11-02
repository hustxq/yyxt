<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();
	
	//$productid = isset($_GET['phone']) ? mysql_real_escape_string($_GET['phone']) : '';
	

	include 'conn.php';
	
	//itemid like '$itemid%' and 
	//$where = "where phone like '%$productid%'";
	
	$rs = mysql_query("select count(*) from easyui_admin");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("select * from easyui_admin ". " order by id desc limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>