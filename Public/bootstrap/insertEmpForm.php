<?php
session_start();//创建或查找已存在的PHPSESSID
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加员工表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="http://localhost:8080/webClass/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/bootstrap.min.js"></script>
		<style type="text/css">
		</style>
		<script type="text/javascript">
			$(function(){
				$.getJSON("../course09_RequestAndResponse/getAllDept.php",function(data){
					$("#deptid").empty();
					$("#deptid").append('<option value="0">请选择部门</option>');
					for(var i=0;i<data.length;i++){
						$("#deptid").append('<option value="'+data[i].deptid+'">'+data[i].deptName+'</option>');
					}
				});
			});
			function backToListPage() {
				location.href = "empList.php";
			}
		</script>
	</head>
	<body>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">新增员工</h3>
			</div>
			<div class="panel-body">
				<form id="ff" onreset="backToListPage();" action="../course09_RequestAndResponse/insertEmp.php" method="post">
        			<div class="form-group has-feedback">
        				<label>姓名</label>
        				<input type="text" class="form-control" id="empName" name="empName" placeholder="姓名" />
        				<span class="glyphicon form-control-feedback"></span>
        				<font></font>
        			</div>
        			<div class="form-group has-feedback">
        				<label>手机</label>
        				<input type="text" class="form-control" id="phone" name="phone" placeholder="手机" />
        				<span class="glyphicon form-control-feedback"></span>
        				<font></font>
        			</div>
        			<div class="form-group has-feedback">
        				<label>邮箱</label>
        				<input type="text" class="form-control" id="email" name="email" placeholder="邮箱" />
        				<span class="glyphicon form-control-feedback"></span>
        				<font></font>
        			</div>
        			<div class="form-group has-feedback">
        				<label>年龄</label>
        				<input type="text" class="form-control" id="age" name="age" placeholder="年龄" />
        				<span class="glyphicon form-control-feedback"></span>
        				<font></font>
        			</div>
        			<div class="form-group">
        				<label>性别</label>
        				<input type="radio" name="gender" value="1" checked />男
        				<input type="radio" name="gender" value="2" />女
        			</div>
          			<div class="form-group">
        				<label>所属部门</label>
        				<select name="deptid" class="form-control" id="deptid">
        					<option value="0">请选择部门</option>
        				</select>
        			</div>
          			<div class="form-group text-center">
          				<button class="btn btn-primary" style="width: 100px;" id="btn-login" type="submit">确认</button>
          				<button class="btn btn-default" style="width: 100px;" type="reset">取消</button>
          			</div>
        		</form>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>