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
<link rel="stylesheet" type="text/css"
	href="easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<script type="text/javascript" src="easyui/jquery.min.js"></script>
<script type="text/javascript" src="easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="easyui/locale/easyui-lang-zh_CN.js"></script>
<style type="text/css">
A:link {
	COLOR: #000000;
	FONT-FAMILY: arial;
	TEXT-DECORATION: none
}

A:visited {
	COLOR: #0000FF;
	FONT-FAMILY: arial;
	TEXT-DECORATION: none
}

A:active {
	COLOR: #FF0000;
	FONT-FAMILY: arial;
	TEXT-DECORATION: none
}

A:hover {
	COLOR: #FF0000;
	FONT-FAMILY: arial;
	TEXT-DECORATION: underline
}
</style>
</head>

<body class="easyui-layout">
	<script type="text/javascript">
		var index = 0;
		function addPanel(url, title) {
			if (!$('#tt').tabs('exists', title)) {
				$('#tt')
						.tabs(
								'add',
								{
									title : title,
									content : '<iframe src="'
											+ url
											+ '" frameBorder="0" border="0"  style="width: 100%; height: 99%; scrolling="no";"/>',
									closable : true
								});
			} else {
				$('#tt').tabs('select', title);
			}
		}
		function removePanel() {
			var tab = $('#tt').tabs('getSelected');
			if (tab) {
				var index = $('#tt').tabs('getTabIndex', tab);
				$('#tt').tabs('close', index);
			}
		}

		 //删除Tabs
	    function closeTab(menu, type) {
	        var allTabs = $("#tt").tabs('tabs');
	        var allTabtitle = [];
	        $.each(allTabs, function (i, n) {
	            var opt = $(n).panel('options');
	            if (opt.closable)
	                allTabtitle.push(opt.title);
	        });
	        var curTabTitle = $(menu).data("tabTitle");
	        var curTabIndex = $("#tt").tabs("getTabIndex", $("#tt").tabs("getTab", curTabTitle));
	        switch (type) {
	            case 1:
	                $("#tt").tabs("close", curTabIndex);
	                return false;
	                break;
	            case 2:
	                for (var i = 0; i < allTabtitle.length; i++) {
	                    $('#tt').tabs('close', allTabtitle[i]);
	                }
	                break;
	            case 3:
	                for (var i = 0; i < allTabtitle.length; i++) {
	                    if (curTabTitle != allTabtitle[i])
	                        $('#tt').tabs('close', allTabtitle[i]);
	                }
	                $('#tt').tabs('select', curTabTitle);
	                break;
	            case 4:
	                for (var i = curTabIndex; i < allTabtitle.length; i++) {
	                    $('#tt').tabs('close', allTabtitle[i]);
	                }
	                $('#tt').tabs('select', curTabTitle);
	                break;
	            case 5:
	                for (var i = 0; i < curTabIndex-1; i++) {
	                    $('#tt').tabs('close', allTabtitle[i]);
	                }
	                $('#tt').tabs('select', curTabTitle);
	                break;
	            case 6: //刷新
	                var panel = $("#tt").tabs("getTab", curTabTitle).panel("refresh");
	                break;
	        }
	    }

	    $(document).ready(function () {
	        //监听右键事件，创建右键菜单
	        $('#tt').tabs({
	            onContextMenu: function (e, title, index) {
	                e.preventDefault();
	                if (index > 0) {
	                    $('#mm').menu('show', {
	                        left: e.pageX,
	                        top: e.pageY
	                    }).data("tabTitle", title);
	                }
	            }
	        });
	        //右键菜单click
	        $("#mm").menu({
	            onClick: function (item) {
	                closeTab(this, item.name);
	            }
	        });

	        var setting = {
	            view: {
	                selectedMulti: false
	            },
	            callback: {
	                onClick: addTabs
	            }
	        };

	    });
</script>

	<div
		data-options="region:'north',title:'header',split:true,noheader:true"
		style="height: 60px; background: #666;">
		<div class="logo">后台管理</div>
		<div class="logout">
			您好，
			<?php echo $_SESSION['qx'].':'.$_SESSION['admin']?>
			| <a class="head" href="logout.php">退出</a>
		</div>
	</div>


	<div
		data-options="region:'south',title:'footer',split:true,noheader:true"
		style="height: 35px; line-height: 30px; text-align: center;">
		&copy;2016-2017 Hust Xq. Powered by PHP and EasyUI.</div>

	<div
		data-options="region:'west',title:'导航',split:true,iconCls:'icon-world'"
		style="width: 180px; padding: 10px;">
		<ul id="tt1" class="easyui-tree">
			<li iconCls="icon-system"><span>采购管理</span>
				<ul>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_cgdd/sdemo.html','采购订单')">采购订单</a></span></li>
		<!-- 			<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_cgdh/sdemo.html','采购到货')">采购到货</a></span></li>
				<li><span><a href="javascript:void(0)"
							onclick="addPanel('./print/index.php','采购打印')">采购打印</a></span></li>
		 -->	
				</ul>	
				
			<li iconCls="icon-kcgl"><span>库存管理</span>
				<ul>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_cgdh/sdemo.html','库存明细')">库存明细</a></span></li>
				<!-- 	<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_cgdh/sdemo.html','采购到货')">采购到货</a></span></li>
				 -->
				</ul>	
				
			<li iconCls="icon-user"><span>销售管理</span>
				<ul>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_xsgl/sdemo.html','销售出库')">销售出库</a></span></li>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./edg_xsjl/sdemo.html','销售记录')">销售记录</a></span></li>
					 
				</ul>
			
			<li iconCls="icon-group"><span>资料管理</span>
				<ul>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./khgl/index.html','客户管理')">客户管理</a></span></li>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./gysgl/index.html','供应商管理')">供应商管理</a></span></li>
				</ul>
			
			<li iconCls="icon-manager"><span>系统管理</span>
				<ul>
					<!-- <li><span><a href="javascript:void(0)"
							onclick="addPanel('./xtgl/zhgl.html','账户管理')">账号管理</a></span></li>
					 -->
					 <li><span><a href="javascript:void(0)"
							onclick="addPanel('./xtgl/mmgl.html','密码管理')">密码管理</a></span></li>
				</ul>
			
			<!-- <li><span><a href="javascript:void(0)"
							onclick="addPanel('./dgex/index.html','行可展开')">行可展开</a></span></li>
			<li><span><a href="javascript:void(0)"
					onclick="addPanel('./edg/sdemo.html','可编辑行带搜索')">可编辑行带搜索</a></span></li>
			 -->
		</ul>
		<!-- 	<li><span><a href="javascript:void(0)"
									onclick="addPanel('http://www.baidu.com','baidu')">baidu</a></span></li>
							<li><span><a href="javascript:void(0)"
									onclick="addPanel('./jac1/index.html','用户资料')">用户资料</a></span></li>
							<li><span><a href="javascript:void(0)"
									onclick="addPanel('./zlgl/khgl.php','tab3')">资料管理</a></span></li>

							<li><span><a href="javascript:void(0)"
									onclick="addPanel('./cgdd/index.html','采购订单')">采购订单</a></span></li>


						</ul></li>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./search/search_demo.html','tab4')">搜索</a></span></li>
					<li><span><a href="javascript:void(0)"
							onclick="addPanel('./dgex/index.html','行可展开')">行可展开</a></span></li>
				</ul></li>
			<li><span><a href="javascript:void(0)"
					onclick="addPanel('./edg/sdemo.html','可编辑行带搜索')">可编辑行带搜索</a></span></li>
					 -->
	</div>
	<div data-options="region:'center'" style="overflow: hidden;">
		<div id="tt" class="easyui-tabs" fit="true" border="false">
			<div title="起始页" iconCls="icon-house"
				style="padding: 10 10px; display: block;">欢迎来到后台管理系统！</div>
		</div>
	</div>
	
<div id="mm" class="easyui-menu" style="width:120px;">
    <div id="mm-tabclosrefresh" data-options="name:6">刷新</div>
    <div id="mm-tabclose" data-options="name:1">关闭</div>
    <div id="mm-tabcloseall" data-options="name:2">全部关闭</div>
    <div id="mm-tabcloseother" data-options="name:3">除此之外全部关闭</div>
    <div class="menu-sep"></div>
    <div id="mm-tabcloseright" data-options="name:4">当前页右侧全部关闭</div>
    <div id="mm-tabcloseleft" data-options="name:5">当前页左侧全部关闭</div>
</div>
</body>
</html>