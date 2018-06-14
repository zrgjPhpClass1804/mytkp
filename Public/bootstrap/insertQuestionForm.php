<?php
session_start();//创建或查找已存在的PHPSESSID
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加题库表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="http://localhost:8080/webClass/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/bootstrap.min.js"></script>
		<style type="text/css">
		</style>
		<script type="text/javascript">
			$(function(){
				$.getJSON("../index.php?c=question&a=getAllCourse",function(data){
					$("#courseId").empty();
					$("#courseId").append('<option value="0">请选择科目</option>');
					for(var i=0;i<data.length;i++){
						$("#courseId").append('<option value="'+data[i].cid+'">'+data[i].courseName+'</option>');
					}
				});

				$("#btn-add").click(function(){
					if($("input[name=type]:checked").length == 0){
						alert("请选择题型！");
						return;
					}
					$.post("../index.php",{
						c:"question",
						a:"addQuestion",
						content: $("#content").val(),
						courseId: $("#courseId").val(),
						parse: $("#parse").val(),
						type: $("input[name=type]:checked").val()
					},function(){
						location.href = "showQuestion.view.php";
					}, "text");
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
				<h3 class="panel-title">新增题目</h3>
			</div>
			<div class="panel-body">
				<form id="ff" onreset="backToListPage();">
        			<div class="form-group has-feedback">
        				<label>题干</label>
        				<textarea class="form-control" id="content" name="content" placeholder="请填入题目内容"></textarea>
        				<span class="glyphicon form-control-feedback"></span>
        			</div>
        			<div class="form-group has-feedback">
        				<label>题型</label>
        				<input type="radio" name="type" value="1" />单选
        				<input type="radio" name="type" value="2" />多选
        				<span class="glyphicon form-control-feedback"></span>
        			</div>
          			<div class="form-group">
        				<label>所属科目</label>
        				<select name="courseId" class="form-control" id="courseId">
        					<option value="0">请选择科目</option>
        				</select>
        			</div>
        			<div class="form-group has-feedback">
        				<label>解析</label>
        				<textarea class="form-control" id="parse" name="parse" placeholder="请填入题目解析内容"></textarea>
        				<span class="glyphicon form-control-feedback"></span>
        				<font></font>
        			</div>
          			<div class="form-group text-center">
          				<button class="btn btn-primary" style="width: 100px;" id="btn-add" type="button">确认</button>
          				<button class="btn btn-default" style="width: 100px;" type="reset">取消</button>
          			</div>
        		</form>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>