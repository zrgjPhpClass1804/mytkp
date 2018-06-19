<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>资料上传</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<style type="text/css">
            #d{
				width: 100px;
				height: 100px;
				border: 1px dashed blue;
				cursor: pointer;
				box-sizing: border-box;
				padding-top: 8px;
			}
			#d img{
				width: 75px;
				height: 80px;
			}
			#file{
				display: none;
			}
        </style>
        <script type="text/javascript">
			$(function(){
				$("#d").click(function(){
					$("#file").trigger("click");
				});
				$("#file").change(function(){
					var files = this.files;
					//开始循环上传
					for(var i=0;i<files.length;i++){
						//先添加一个图片div 先使用默认图片 待上传完成后更换为刚刚上传的图片
						//让滚动条滚动到底部
						var formdata = new FormData();
						//添加文件数据字段
						formdata.append("fileList", files[i]);
						var xhr = new XMLHttpRequest();//DOM标准的获取对象方式
						/******绑定上传事件******/
						// 进度条
						xhr.upload.onprogress = function(e){
							// event.total是需要传输的总字节，event.loaded是已经传输的字节。
							// 如果event.lengthComputable不为真，则event.total等于0
							var p = Math.round(e.loaded / e.total * 100, 1) + "%";//百分比  Math.round是取整并四舍五入
							if (e.lengthComputable) {
								$("#progressBar").css("width",p);
								$("#progressBarText").text("已完成 "+p);
							}
						};
						//完成
						xhr.onload = function(e){
							var ss = e.target.responseText;
							alert(ss);
							//Servlet中返回的字符串格式为: 图片的path,图片保存数据库中的主键值
							//上传完成后预览图片
						};
						//上传失败
						xhr.onerror = function(e){
							alert("上传失败！");
						};
						xhr.open("POST","../../index.php/Home/File/fileUpload", true);
						xhr.setRequestHeader("X_FILENAME", encodeURI(files[i].name));
						xhr.send(formdata);
					}
				});
			});
        </script>
	</head>
	<body>
		<br/>
		<br/>
		<br/>
		<div class="row">
			<input type="file" name="file" id="file" />
			<div class="col-md-6 col-md-offset-3" id="d">
				<img src="img/add_img.png" title="点击选择文件" />
			</div>
		</div>
		<br/>
		<div class="progress">
			<div class="progress-bar progress-bar-info progress-bar-striped" id="progressBar" style="width: 0%;">
				<span id="progressBarText"></span>
			</div>
		</div>
	</body>
</html>