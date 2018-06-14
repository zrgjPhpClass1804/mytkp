<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>角色列表</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(function(){
            $.getJSON("../../index.php/home/Permission/loadAllRoles",function(data){
                $(data).each(function(i){
                    $("#roleData").append('<tr>'+
                        '<td>' + this.rid + '</td>'+
                        '<td>' + this.rolename + '</td>'+
                        '<td><a href="userrole.php?rid='+this.rid+'" class="btn btn-info btn-xs">用户角色</a>&nbsp;&nbsp;<a href="rolemenu.php?rid='+this.rid+'" class="btn btn-success btn-xs">角色权限</a></td>'+
                        '</tr>');
                });
            });
        });
        </script>
    </head>
    <body>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>角色编号</th>
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="roleData"></tbody>
        </table>
    </body>
</html>
