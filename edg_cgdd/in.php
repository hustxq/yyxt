<?php
session_start ();
if (! isset ( $_SESSION ['admin'] )) {
	header ( 'location:index.php' );
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Add search functionality in DataGrid - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css"
	href="http://www.jeasyui.net/Public/js/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css"
	href="http://www.jeasyui.net/Public/js/easyui/themes/icon.css">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="http://www.w3cschool.cc/try/jeasyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.w3cschool.cc/try/jeasyui/jquery.edatagrid.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.net/Public/js/easyui/locale/easyui-lang-zh_CN.js" ></script>
	<script type="text/javascript">
	$(function(){
		$('#tt').edatagrid({
			//url: 'get_users.php',
			saveUrl: 'save_user.php',
			updateUrl: 'update_user.php',
			destroyUrl: 'destroy_user.php'
		});
	});
	
	function doSearch(){
			$('#tt').datagrid('load',{
				itemid: $('#st_c').val(),
				productid: $('#productid').val()
			});
		}
	
	function submitdd() {
		var itemid = $('#st_c').val();
		var productid = $('#productid').val();
		//alert(itemid+","+productid);
		$.messager.confirm('Confirm',
				'确认提交此订单吗?', function(r) {
					if (r) {
						$.get('destroy_all.php?itemid='+itemid+'&productid='+productid);
					}
				});
	}
	</script>
</head>
<body>	
	<table id="tt" class="easyui-datagrid" style="width: 100%; height: 450px"
			url="datagrid24_getdata.php" fit="true"
			toolbar="#tb"
			rownumbers="true" pagination="true">
		<thead>
			<tr>
				<th field="spbh" width="150" align="center" editor="{type:'validatebox',options:{required:true}}">商品编号</th>
				<th field="spmc" width="150" align="center" editor="{type:'validatebox',options:{required:true}}">商品名称</th>
				<th field="spgg" width="150" align="center" editor="text">商品规格</th>
				<th field="bzdw" width="150" align="center" editor="text">包装单位</th>
				
				<th field="bzsl" width="150" align="right" editor="text">包装数量</th>
				<th field="lssl" width="150" align="right" editor="text">零散数量</th>
				<th field="sl" width="150" align="right" editor="text">数量</th>
				<th field="hsj" width="150" align="right" editor="text">含税价</th>
				
				<th field="je" width="150" align="right" editor="text">金额</th>
				<th field="scqy" width="150" align="right" editor="text">生产企业</th>
				<th field="bz" width="150" align="right" editor="text">备注</th>
				<th field="jlgg" width="150" align="right" editor="text">计量规格</th>
			
			</tr>
		</thead>
	</table>
	<div id="tb" style="padding:3px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#tt').edatagrid('addRow')">新增</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#tt').edatagrid('destroyRow')">删除</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tt').edatagrid('saveRow')">保存</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tt').edatagrid('cancelRow')">取消</a>
		
		<select name="st_c" id="st_c" style="width:80px;">
			<option value="spmc">商品名称</option>
			<option value="spbh">商品编号</option>
			<option value="scqy">生产企业</option>
		</select>
		<input id="productid" style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="doSearch()">搜索</a>
		
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="submitdd()">提交订单</a>
		
	</div>	
</body>
</html>