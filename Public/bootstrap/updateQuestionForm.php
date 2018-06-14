<?php
session_start();//创建或查找已存在的PHPSESSID
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>修改题库表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="http://localhost:8080/webClass/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/bootstrap.min.js"></script>
		<style type="text/css">
        .div-option *{
        	 display: block;
        	 float: left;
        }
        .div-option input{
	         width: 85%;
        }
		</style>
		<script type="text/javascript">
			$(function(){
				$.getJSON("../index.php?c=question&a=loadQuestionById&qid=<?php echo $_GET["qid"];?>",function(question){
					$("#qid").val(question.qid);
					$("#content").val(question.content);
					$("#parse").val(question.parse);
					$("#answer").val(question.answer);
					if(question.type == 1){
						$("input[name=type]").eq(0).prop("checked", true);
					}else if(question.type == 2){
						$("input[name=type]").eq(1).prop("checked", true);
					}
					$.getJSON("../index.php?c=question&a=getAllCourse",function(data){
						$("#courseId").empty();
						$("#courseId").append('<option value="0">请选择科目</option>');
						for(var i=0;i<data.length;i++){
							$("#courseId").append('<option value="'+data[i].cid+'">'+data[i].courseName+'</option>');
						}
						$("#courseId").val(question.courseId);
					});
				});

				$.getJSON("../index.php?c=question&a=loadOptionsByQid&qid=<?php echo $_GET["qid"];?>",function(data){
					for(var i=0;i<data.length;i++){
    					$("#ff").append('<div class="form-group has-feedback col-md-6 col-md-offset-3 div-option">'+
    							'<input type="hidden" name="optionId" value="'+ data[i].oid +'"/>'+
              					'<input type="text" name="optionContent" placeholder="请填入选项内容 例如 A.XXXXXX" class="form-control" value="'+ data[i].content +'" />'+
                  				'<button type="button" class="btn btn-success btn-addOption-insert">确认</button>'+
                  			'</div>');
					}
				});

				$("#btn-add").click(function(){
					$.post("../index.php",{
						c:"question",
						a:"updateQuestion",
						qid: $("#qid").val(),
						answer: $("#answer").val(),
						type: $("input[name=type]:checked").val(),
						content: $("#content").val(),
						courseId: $("#courseId").val(),
						parse: $("#parse").val()
					},function(){
						location.href = "showQuestion.view.php";
					}, "text");
				});


				$("#btn-addOption").click(function(){
					$("#ff").append('<div class="form-group has-feedback col-md-6 col-md-offset-3 div-option">'+
								'<input type="hidden" name="optionId" value="-1"/>'+
	          					'<input type="text" name="optionContent" placeholder="请填入选项内容 例如 A.XXXXXX" class="form-control" />'+
	              				'<button type="button" class="btn btn-success btn-addOption-insert">确认</button>'+
	              			'</div>');
				});

				$("#ff").on("click", ".btn-addOption-insert", function(){
					var optionId = $(this).parent().find("input[name=optionId]").eq(0).val();
					$.post("../index.php",{
						c:"question",
						a:"addOption",
						optionId:optionId,
						qid: $("#qid").val(),
						content: $(this).prev("input[name=optionContent]").val()
					},function(data){
						alert(data);
					},"text");
				});
				
			});
			function backToListPage() {
				location.href = "showQuestion.view.php";
			}
		</script>
	</head>
	<body>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">修改题目</h3>
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
        				<label>正确答案</label>
        				<input class="form-control" id="answer" name="answer" placeholder="请填入题目正确答案 多选以逗号隔开" />
        				<span class="glyphicon form-control-feedback"></span>
        			</div>
        			<div class="form-group has-feedback">
        				<label>解析</label>
        				<textarea class="form-control" id="parse" name="parse" placeholder="请填入题目解析内容"></textarea>
        				<span class="glyphicon form-control-feedback"></span>
        			</div>
          			<div class="form-group text-center">
          				<button class="btn btn-primary" style="width: 100px;" id="btn-add" type="button">确认</button>
          				<button class="btn btn-default" style="width: 100px;" type="reset">取消</button>
          				<button class="btn btn-default" style="width: 100px;" type="button" id="btn-addOption">添加选项</button>
          			</div>
          			<input type="hidden" id="qid" />
        		</form>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>