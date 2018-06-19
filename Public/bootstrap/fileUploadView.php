<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>设置头像表单</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<style type="text/css">
            #fileName{
	            display: none;
            }
            .up{
	            display: block;
            	float: left;
            }
        </style>
        <script type="text/javascript">
			$(function(){
				$("#fileNameShow").val("");
				$("#btn-selectFile").click(function(){
					//$("#fileName").click();
					$("#fileName").trigger("click");
				});
				$("#fileName").change(function(){
					$("#fileNameShow").val($(this).val());
				});
			});
        </script>
	</head>
	<body>
	
		<br>
		<br>
		<br>
	
		<div class="col-md-6 col-md-offset-3">
			<form action="../../index.php/Home/User/setHeadPicture" method="post" enctype="multipart/form-data">
				<input type="file" name="headPicture" id="fileName" />
				<div class="form-group">
					<input type="text" class="form-control up" id="fileNameShow" style="width: 75%;" readonly />
					<button type="button" id="btn-selectFile" class="btn btn-success up" style="margin-left: -5px;">选择文件</button>
				</div>
				<div class="form-group" style="height: 50px;"></div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">确认上传</button>
				</div>
			</form>
		</div>
	
	</body>
</html>