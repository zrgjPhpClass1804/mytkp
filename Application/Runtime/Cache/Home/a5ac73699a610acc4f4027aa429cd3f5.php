<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        哈哈<br>
        <table class="table" border="1" width="100%">
            <!--
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$msg" ;else: foreach($__LIST__ as $key=>$u): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($i); ?></td>
                    <td><?php echo ($u["userid"]); ?></td>
                    <td><?php echo ($u["username"]); ?></td>
                    <td><?php echo ($u["userpass"]); ?></td>
                    <td><?php echo ($u["realname"]); ?></td>
                    <td><?php echo ($u["headpicture"]); ?></td>
                </tr><?php endforeach; endif; else: echo "$msg" ;endif; ?>
            <?php if(is_array($data)): foreach($data as $i=>$u): ?><tr>
                    <td><?php echo ($i); ?></td>
                    <td><?php echo ($u["userid"]); ?></td>
                    <td><?php echo ($u["username"]); ?></td>
                    <td><?php echo ($u["userpass"]); ?></td>
                    <td><?php echo ($u["realname"]); ?></td>
                    <td><?php echo ($u["headpicture"]); ?></td>
                </tr><?php endforeach; endif; ?>
            <?php $__FOR_START_16952__=0;$__FOR_END_16952__=$dataSize;for($i=$__FOR_START_16952__;$i < $__FOR_END_16952__;$i+=1){ ?>-->
            <for start="$dataSize-1" end="0" comparison="egt" step="-1" name="i">
                <tr>
                    <td><?php echo ($i); ?></td>
                    <td><?php echo ($data[$i]["userid"]); ?></td>
                    <td><?php echo ($data["$i"]["username"]); ?></td>
                    <td><?php echo ($data["$i"]["userpass"]); ?></td>
                    <td><?php echo ($data[$i]["realname"]); ?></td>
                    <td><?php echo ($data[$i]["headpicture"]); ?></td>
                </tr><?php } ?>
        </table>
    </body>

</html>