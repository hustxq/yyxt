$(function () {
	
	//登录界面
	$('#login').dialog({
		title : '登录后台',
		width : 300,
		height : 180,
		modal : true,
		iconCls : 'icon-login',
		buttons : '#btn',
	});
	
	//管理员帐号验证
	$('#manager').validatebox({
		required : true,
		missingMessage : '请输入管理员帐号',
		invalidMessage : '管理员帐号不得为空',
	});
	
	//管理员密码验证
	$('#password').validatebox({
		required : true,
		//validType : 'length[6,30]',
		missingMessage : '请输入管理员密码',
		invalidMessage : '管理员密码不得为空',
	});
	
	//加载时判断验证
	if (!$('#manager').validatebox('isValid')) {
		$('#manager').focus();
	} else if (!$('#password').validatebox('isValid')) {
		$('#password').focus();
	}
	
	$("#test a").click(function(){
		$.post('http://localhost:8080/Test/json', {
			id : row.id
		}, function(result) {
			if (result.success) {
				//$('#tt').datagrid('reload'); // reload the user data
				$.messager.show({
					title:'成功',
					msg : result.msg,
				});
			} else {
				$.messager.show({ // show error message
					title : '错误',
					msg : result.msg
				});
			}
		}, 'json');
	});
	//单击登录
	$('#btn a').click(function () {
		if (!$('#manager').validatebox('isValid')) {
			$('#manager').focus();
		} else if (!$('#password').validatebox('isValid')) {
			$('#password').focus();
		} else {
			$.ajax({
				url : 'checklogin.php',
				type : 'post',
				data : {
					manager : $('#manager').val(),
					password : $('#password').val(),
				},
				beforeSend : function () {
					$.messager.progress({
						text : '正在登录中...',
					});
				},
				success : function (data, response, status) {
					$.messager.progress('close');
					
					if (data == 1) {
						location.href = 'home.php';
					} else if(data == 2){
						location.href = 'home2.php';
					}else{
						$.messager.alert('登录失败！', '用户名或密码错误！', 'warning', function () {
							$('#password').select();
						});
					}
				}
			});
		}
	});
	
});








