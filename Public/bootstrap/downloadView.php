<?php
session_start();//创建或查找已存在的PHPSESSID
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>提供下载的资源</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="http://localhost:8080/webClass/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/webClass/bootstrap/js/bootstrap.min.js"></script>
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
		</style>
		<script type="text/javascript">
			$(function(){
				$(".btn-download").click(function(){
					var uri = encodeURI($(this).parent().parent().find("input[type=hidden]").eq(0).val());
					location.href = "../course11_file/downloadHandle.php?path=" + uri;
				});
			});
		</script>
	</head>
	<body>
		
		
		
		
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>名称</th>
					<th>大小</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$path = $_SERVER["DOCUMENT_ROOT"]."/webClass/download";
				$dir = opendir($path);
				while($f = readdir($dir)){
				    if($f == "." || $f == ".."){
				        continue;
				    }
				    $fs = filesize($path."/".$f);
				    
				    if($fs < 1024){
				        $fsShow = $fs."B";
				    }elseif ($fs < 1024*1024){
				        $fsShow = round($fs/1024, 1) . "KB";
				    }elseif ($fs < 1024*1024*1024){
				        $fsShow = round($fs/1024/1024, 1) . "MB";
				    }else{
				        $fsShow = round($fs/1024/1024/1024, 1) . "GB";
				    }
				    
				    echo "<tr>";
				    echo "<td>".mb_convert_encoding($f, "UTF-8", "GBK")."<input type='hidden' value='".$path."/".mb_convert_encoding($f, "UTF-8", "GBK")."'/></td>";
				    echo "<td>".$fsShow."</td>";
				    echo "<td><button type='button' class='btn btn-danger btn-xs btn-download'>下载</button></td>";
				    echo "</tr>";
				}
				?>
			</tbody>
		</table>
		
	</body>
</html>