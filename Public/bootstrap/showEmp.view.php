<?php
session_start();//创建或查找已存在的PHPSESSID
//require_once '../course10_DBUtil/Page.class.php';
//$page = unserialize($_SESSION["pageOfEmp"]);//反序列化
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="http://localhost:8080/webClass/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/bootstrap.min.js"></script>
		<style type="text/css">
		    .text-center{
	            margin-top: -20px;
		    }
		</style>
		<script type="text/javascript">
			function showData(page){
				$("#pageNo").val(page.pageNo);
				$("#pageSize").val(page.pageSize);
				$("#total").val(page.total);
				$("#tableData").empty();
				for(var i=0;i<page.data.length;i++){
					$("#tableData").append(
						"<tr>"+
     			    	"<td>"+ page.data[i].empid +"</td>"+
     			        "<td>"+ page.data[i].empName +"</td>"+
     			    	"<td>"+ page.data[i].age +"</td>"+
     			    	"<td>"+ (page.data[i].gender==1?"男":"女") +"</td>"+
     			    	"<td>"+ page.data[i].phone +"</td>"+
     			    	"<td>"+ page.data[i].email +"</td>"+
     			    	"<td>"+ page.data[i].deptName +"</td>"+
     			    	"<td><a class='btn btn-info btn-xs' href='updateEmpForm.php?empid="+page.data[i].empid+"'>更新</a>&nbsp;&nbsp;<a class='btn btn-danger btn-xs' href='javascript:delEmpById("+page.data[i].empid+");'>删除</a></td>"+
     			    	"</tr>");
				}
				//分页导航条的处理
				var pageNo = $("#pageNo").val();//当前展示页码
				var pageSize = $("#pageSize").val();//当前页展示的数据行数
				var total = $("#total").val();//总行数
				var pageCount = total%pageSize==0 ? total/pageSize : Math.floor(total/pageSize) + 1;//总页数
				$("#pagination>li").removeClass("disabled");
				if(pageNo == 1){
					$("#pagination>li").eq(0).addClass("disabled");
					$("#pagination>li").eq(0).html('<span aria-hidden="true">&laquo;</span>');
				}else{
					$("#pagination>li").eq(0).html('<a href="javascript:changePage(-1, 10);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>');
				}
				if(pageNo == pageCount){
					$("#pagination>li:last-child").addClass("disabled");
					$("#pagination>li:last-child").html('<span aria-hidden="true">&raquo;</span>');
				}else{
					$("#pagination>li:last-child").html('<a href="javascript:changePage(0, 10);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>');
				}
				if(pageCount < 5){
					for(var i=1;i<=5;i++){
						if(i > pageCount){
							$("#pagination>li").eq(i).addClass("disabled");
							$("#pagination>li").eq(i).html('<span>'+i+'</span>');
						}else{
							$("#pagination>li").eq(i).html('<a href="javascript:changePage('+i+', 10);">'+i+'</a>');
						}
					}
				}
			}
			$(function(){
				//页面加载时默认展示第一页 无搜索条件
				$.post("../course09_RequestAndResponse/showEmp.handle.php",{pageNo:1,pageSize:10},function(page){
					showData(page);
				},"json");
				//异步加载所有部门，填入到按部门搜索下拉框中
				$.getJSON("../course09_RequestAndResponse/getAllDept.php",function(data){
					$("#searchDeptid").empty();
					$("#searchDeptid").append('<option value="0">按部门搜索</option>');
					for(var i=0;i<data.length;i++){
						$("#searchDeptid").append('<option value="'+data[i].deptid+'">'+data[i].deptName+'</option>');
					}
				});
				//搜索
				$("#btn-search").click(function(){
					$.post("../course09_RequestAndResponse/showEmp.handle.php",
							{
								pageNo:1,
								pageSize:10,
								searchName:$("#searchName").val(),
								searchDeptid:$("#searchDeptid").val(),
								searchGender:$("input[name=searchGender]:checked").val()
							},
							function(page){
						showData(page);
					},"json");
				});
				//显示全部
				$("#btn-showAll").click(function(){
					$("#searchForm")[0].reset();
					$("#btn-search").click();//触发搜索按钮的点击事件
				});
			});
			
			/**
			 * toPageNo --> 翻页后展示页码  传入正整数表示直接跳转到第几页， 传入0表示上一页 传入-1表示下一页
			 * pageSize --> 当前页展示的数据行数
			 */ 
			function changePage(toPageNo, pageSize){
				var pageNo = $("#pageNo").val();//当前展示页码
				if(toPageNo == -1){
					//上一页
					toPageNo = pageNo-1;
				}else if(toPageNo == 0){
					toPageNo = parseInt(pageNo)+1;
				}else if(toPageNo > 0){
				}
				$.post("../course09_RequestAndResponse/showEmp.handle.php",{
					pageNo:toPageNo,
					pageSize:10,
					searchName:$("#searchName").val(),
					searchDeptid:$("#searchDeptid").val(),
					searchGender:$("input[name=searchGender]:checked").val()
				},function(page){
    				showData(page);
    			},"json");
			}
			function delEmpById(empid){
				if(confirm("你确定要删除这个员工吗？")){
					location.href = "../course09_RequestAndResponse/deleteEmpById.php?empid=" + empid;
				}
			}
		</script>
	</head>
	<body>
		<input type="hidden" id="total" value="" />
		<table class="table table-bordered table-striped table-hover">
			<caption>
				<form id="searchForm">
					<input type="hidden" id="pageNo" name="pageNo" value="" />
					<input type="hidden" id="pageSize" name="pageSize" value="" />
					<div class="form-group col-md-2">
						<input type="text" placeholder="按姓名搜索" name="searchName" class="form-control" id="searchName" />
					</div>
					<div class="form-group col-md-2">
    					<select name="searchDeptid" class="form-control" id="searchDeptid">
        					<option value="0">按部门搜索</option>
        				</select>
    				</div>
    				<div class="form-group col-md-1" style="line-height: 35px;">
    					<input type="radio" name="searchGender" value="1" />男
    					<input type="radio" name="searchGender" value="2" />女
					</div>
    				<div class="form-group col-md-7">
    					<button type="button" class="btn btn-primary btn-sm" id="btn-search"><span class="glyphicon glyphicon-search"></span>&nbsp;搜索</button>
    					<button type="button" class="btn btn-success btn-sm" id="btn-showAll"><span class="glyphicon glyphicon-search"></span>&nbsp;显示全部</button>
    					<a href="insertEmpForm.php" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-plus"></span>&nbsp;新增</a>
    				</div>
				</form>
			</caption>
			<thead>
				<tr>
    				<th>编号</th>
    				<th>姓名</th>
    				<th>年龄</th>
    				<th>性别</th>
    				<th>电话</th>
    				<th>邮箱</th>
    				<th>所属部门</th>
    				<th>操作</th>
    			</tr>
			</thead>
			<tbody id="tableData"></tbody>
		</table>
		<div class="text-center">
			<ul class="pagination pagination-sm" id="pagination">
				<li><a href="javascript:changePage(-1, 10);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
				<li><a href="javascript:changePage(1, 10);">1</a></li>
				<li><a href="javascript:changePage(2, 10);">2</a></li>
				<li><a href="javascript:changePage(3, 10);">3</a></li>
				<li><a href="javascript:changePage(4, 10);">4</a></li>
				<li><a href="javascript:changePage(5, 10);">5</a></li>
				<li><a href="javascript:changePage(0, 10);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
			</ul>
		</div>
	</body>
</html>