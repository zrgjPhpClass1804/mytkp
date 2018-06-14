<?php
session_start();//创建或查找已存在的PHPSESSID
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="Public/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="Public/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/bootstrap/js/bootstrap.min.js"></script>
		<style type="text/css">
			.form-group, .checkbox{
				width: 500px;
				margin: auto;
				margin-top: 20px;
			}
			.form-inline,.form-horizontal{
				width: 500px;
				margin: auto;
			}
			font{
	            color: red;
				display: block;
				height: 16px;
			}
			#vcode{
	            width: 85%;
			}
			.vcode{
	            display: block;
				float:left;
			}
			#vcode-img{
				 cursor: pointer;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#vcode-img").click(function(){
					$(this).attr("src", "index.php?c=vcode&a=vcode&" + new Date().getTime());
				});

// 				var txt = '{ "employees" : [' + '{ "firstName":"Bill" , "lastName":"Gates" },' + '{ "firstName":"George" , "lastName":"Bush" },' + '{ "firstName":"Thomas" , "lastName":"Carter" } ]}';
// 				var obj = eval( "("  +  txt  +  ")"  );
// 				alert(obj.employees[0].lastName);				



				
			});
			// function login(){
			// 	var reg1 = /^\w{6,15}$/;
			// 	var reg2 = /^1(3|5|7|8)\d{9}$/;
			// 	var a = false, b = false;
			// 	$("#un").parent().removeClass("has-success has-error");
			// 	$("#un").next("span").removeClass("glyphicon-ok glyphicon-remove");
			// 	if(reg1.test($("#un").val()) || reg2.test($("#un").val())){
			// 		$("#un").parent().addClass("has-success");
			// 		$("#un").next("span").addClass("glyphicon-ok success");
			// 		a = true;
			// 	}else{
			// 		$("#un").parent().addClass("has-error");
			// 		$("#un").next("span").addClass("glyphicon-remove danger");
			// 	}
				
			// 	$("#up").parent().removeClass("has-success has-error");
			// 	$("#up").next("span").removeClass("glyphicon-ok glyphicon-remove");
			// 	if(reg1.test($("#up").val())){
			// 		$("#up").parent().addClass("has-success");
			// 		$("#up").next("span").addClass("glyphicon-ok success");
			// 		b = true;
			// 	}else{
			// 		$("#up").parent().addClass("has-error");
			// 		$("#up").next("span").addClass("glyphicon-remove danger");
			// 	}
			// 	return a && b;
			// }
		</script>
	</head>
	<body>
		
		<form id="ff" onsubmit="" action="index.php/home/user/login" method="post">
			<div class="form-group has-feedback">
				<label>帐号</label>
				<input type="text" class="form-control" id="un" name="userName" placeholder="userName" />
				<span class="glyphicon form-control-feedback"></span>
				<font>
					<?php
    				if(isset($_SESSION["msg"])){
    				    if($_SESSION["msg"] == 3){
    				        echo "登录失败-用户名错误！";
    				    }
    				}
    				?>
				</font>
			</div>
			<div class="form-group has-feedback">
				<label>密码</label>
				<input type="text" class="form-control" id="up" name="userPass" placeholder="userPass" />
				<span class="glyphicon form-control-feedback"></span>
				<font>
					<?php
    				if(isset($_SESSION["msg"])){
    				    if($_SESSION["msg"] == 2){
    				        echo "登录失败-密码错误！";
    				    }
    				}
    				?>
				</font>
			</div>
			<div class="form-group has-feedback">
				<label>验证码</label><br/>
				<input type="text" class="form-control vcode" id="vcode" name="vcode" placeholder="验证码" />
				<span class="glyphicon form-control-feedback"></span>
				<img title="看不清楚？点击换一张" src="../index.php?c=vcode&a=vcode" class="vcode" id="vcode-img" />
				<div class="clearfix"></div>
				<font>
					<?php
    				if(isset($_SESSION["msg"])){
    				    if($_SESSION["msg"] == 4){
    				        echo "登录失败-验证码错误！";
    				    }
    				}
    				?>
				</font>
			</div>
			<div class="checkbox">
    			<label>
      				<input type="checkbox"> 记住我
    			</label>
  			</div>
  			
  			<div class="form-group text-center">
  				<button class="btn btn-primary" style="width: 100px;" id="btn-login" type="submit">登录</button>
  				<span class="btn btn-default">取消</span>
  				<a href="reg.php">立即注册</a>
  			</div>
		</form>
		
		
		<!--<form class="form-inline">
			
			<div class="form-group">
				<label style="width: 200px;" class="text-center">帐号</label>
				<input type="text" class="form-control" placeholder="" style="width: 250px;" />
			</div>
			<div class="form-group">
				<label style="width: 200px;" class="text-center">密码</label>
				<input type="text" class="form-control" placeholder="" style="width: 250px;" />
			</div>
			<div class="checkbox" style="padding-left: 88px;">
    			<label>
      				<input type="checkbox"> 记住我
    			</label>
  			</div>
			
		</form>
		
		
		
		<form class="form-horizontal">
			
			<div class="form-group">
				<label class="col-md-2 control-label">帐号</label>
				<div class="col-md-8">
					<input type="text" class="form-control" placeholder="" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">密码</label>
				<div class="col-md-8">
					<input type="text" class="form-control" placeholder="" />
				</div>
			</div>
			<div class="form-group">
    			<label>
      				<input type="checkbox"> 记住我
    			</label>
  			</div>
			
		</form>
		
		https://github.com   注册
		
		
		
		
		
		-->
		
		
		
	</body>
</html>