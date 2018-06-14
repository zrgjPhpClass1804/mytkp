<?php
session_start();
if(!isset($_SESSION["user"])){
    echo "<script type='text/javascript'>";
    echo "alert('对不起，请先登录！');";
    echo "location.href = 'login.php';";
    echo "</script>";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>后台管理系统</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<style type="text/css">
			body{
				margin: 0;
			}
			.north{
				height: 55px;
				color: #FFFFFF;
				background-image: linear-gradient(to right, #017acd, #f0b7e1);
			}
			.north font{
	            font-weight: bold;
				line-height: 55px;
				margin-right: 20px;
			}
			.content{
				height: 800px;
			}
			.west{
				width: 20%;
				height: 800px;
				float: left;
			}
			.center{
				width: 80%;
				height: 800px;
				float: left;
				background-image: linear-gradient(to bottom, #FFFFFF, #FFFFF0);
			}
			.list-group-item{
				padding: 0;
			}
			.list-group-item>a{
				display: block;
				width: 100%;
				height: 100%;
				padding: 10px 15px;
				text-decoration: none;
			}
			.list-group-item>a:hover{
				text-decoration: none;
				color: #555555;
				font-weight: bold;
			}
			.list-group-item>span{
				display: block;
				width: 100%;
				height: 100%;
				padding: 10px 25px;
				cursor: pointer;
			}
			.list-group-item>span:hover{
				background-color: #4CB0F9;
				color: #FFFFFF;
			}
			.nav-tabs li *{
	            display: block;
				float: left;
				position: relative;
				z-index: 2;
			}
			.close{
	            margin-left: -18px;
			}
			#myTabContent{
	            box-sizing: border-box;
				padding: 10px;
			}
		</style>
		<script type="text/javascript">
			$(function(){
				$(".collapse").on("show.bs.collapse",function(){
					$(this).parent().find("a").css({"background-color":"#0662A6", "color":"#FFFFFF", "font-weight":"bold"});
				}).on("hide.bs.collapse", function(){
					$(this).parent().find("a").css({"background-color":"#FFFFFF", "color":"#337ab7", "font-weight":"normal"});
				});

				$("#btn-exit").click(function() {
					if(confirm("你确定要退出系统吗？")){
						location.href = "../../index.php/home/user/logout";
					}
				});

				$(".secondLevel").click(function(){
					var selectorID = $(this).attr("selectorID");
					var text = $(this).text();
					text = text == null || text == "" ? $(this).attr("title") : text;
					var url = $(this).attr("url");

					var tab = $('#nav-tabs a[href="#'+selectorID+'"]');
					if(tab.length > 0){
						//tab标签已存在，就选中它
						$('#nav-tabs a[href="#'+selectorID+'"]').tab('show');// Select tab by name
					}else{
						//tab标签不存在，就添加
						$("#nav-tabs>li").removeClass("active");
						$("#myTabContent>div").removeClass("in active");
						$("#nav-tabs").append('<li role="presentation" class="active"><a href="#'+selectorID+
								'" data-toggle="tab">'+text+'</a><span class="close">&times;</span></li>');
						$("#myTabContent").append('<div role="tabpanel" class="tab-pane fade in active" id="'+selectorID+
								'"><iframe src="'+url+'" width="100%" height="760px" frameborder="0" framespacing="0" scrolling="no"></iframe></div>');
					}
				});
				$(".nav-tabs").on("click",".close",function(){
					var selector = $(this).prev("a").attr("href");
					$(selector).remove();
					$(this).parent().remove();
					//选中最后一个tab标签页
					$("#nav-tabs a:last").tab('show');
				});

				//获取头像
				var headPictureUrl = "<?php echo $_SESSION["user"]["headpicture"];?>";
				headPictureUrl = headPictureUrl==null||headPictureUrl==""?"../upload/default.png":headPictureUrl;
				$("#headPicture").attr("src", headPictureUrl);

				
			});
		</script>
	</head>
	<body>
		
		<div class="north">
			<button type="button" id="btn-exit" class="btn btn-default pull-right" style="margin-top:10px;margin-right:10px;">退出</button>
			<font class="pull-right">
				<img title="设置头像" selectorID="setHeadPicture" id="headPicture" url="../course11_file/fileUploadView.php" src="../upload/default.png" class="img-circle secondLevel" style="margin-bottom: 4px;cursor: pointer;width:50px;height:50px;">
				<?php 
				    if(isset($_SESSION["user"])){
				        echo $_SESSION["user"]["realname"];
				    }
				?>
			</font>
		</div>
		<div class="content">
			<div class="west">
				<ul class="list-group">
				<?php
				/**
				 * 权限管理-动态展示菜单列表
				 */
				foreach($_SESSION["menus"] as $firstMenu){
					if($firstMenu["level"] == 2){
						echo "<li class='list-group-item firstLevel'>";
						echo	"<a href='#collapse{$firstMenu["mid"]}' data-toggle='collapse'>{$firstMenu["menuname"]}</a>";
						echo	"<div class='collapse' id='collapse{$firstMenu["mid"]}'>";
						echo 		"<ul class='list-group'>";	
						foreach($_SESSION["menus"] as $secondMenu){
							if($secondMenu["level"] == 3 && $secondMenu["parentid"] == $firstMenu["mid"]){
								echo "<li class='list-group-item'>";
								echo	"<span class='secondLevel' selectorID='tabContent{$secondMenu["mid"]}' url='{$secondMenu["url"]}'>{$secondMenu["menuname"]}</span>";
								echo "</li>";
							}
						}
						echo		"</ul>";
						echo	"</div>";
						echo "</li>";
					}
				}
				?>	  
				</ul>
			</div>
			<div class="center">
				<ul class="nav nav-tabs" id="nav-tabs">
  					<li role="presentation" class="active">
  						<a href="#home" data-toggle="tab">Home</a>
  						<span class="close" style="display: none;">&times;</span>
  					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="home">
        				<p>欢迎.</p>
      				</div>
				</div>
			</div>
		</div>
		
		
	</body>
</html>