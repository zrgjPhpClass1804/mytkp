<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>编辑用户角色</title>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(function(){
            var rid = "<?php echo $_GET["rid"];?>";
            $.getJSON("../../index.php/home/Permission/loadUserRoles?rid="+rid,function(data){
                $(data).each(function(){

                    $("#d").append('<div class="checkbox" style="margin-left:20px;">'+
                        '<label>'+
                            '<input type="checkbox" name="userid" value="'+this.userid+'" '+(this.checked==1?"checked":"")+' />'+this.realname+
                        '</label>'+
                    '</div>');
                });
                //全选和取消全选
                $("#checkAll").click(function(){
                    if($(this).prop("checked")){
                        $("input[name=userid]").prop("checked", true);
                        $("#checkAll-text").text("取消全选");
                    }else{
                        $("input[name=userid]").prop("checked", false);
                        $("#checkAll-text").text("全选");
                    }
                });
                $("#bnt-editUserRole").click(function(){
                    //获取已选中的checkbox的value值，形成一个数组
                    var userids = new Array();
                    for(var i=0;i<$("input[name=userid]:checked").length;i++){
                        userids.push($("input[name=userid]:checked").eq(i).val());
                    }
                    $.getJSON("../../index.php/home/Permission/editUserRole?rid="+rid+"&userids="+userids.join(","),function(data){
                        alert(data.result);
                    });
                });
            });
        });
        </script>
    </head>
    <body>
        <div class="checkbox" style="margin-left:20px;">
            <label><input type="checkbox" id="checkAll"/><span id="checkAll-text">全选</span></label>
        </div>
        <div id="d"></div>
        <button type="button" class="btn btn-primary" id="bnt-editUserRole">确认</button>
        <a class="btn btn-default" href="roleList.php">返回</a>
    </body>
</html>
