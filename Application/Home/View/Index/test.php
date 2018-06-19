<!DOCTYPE html>
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
            <volist name="data" id="u" mod="2" empty="$msg" key="i">
                <tr>
                    <td>{$i}</td>
                    <td>{$u.userid}</td>
                    <td>{$u.username}</td>
                    <td>{$u.userpass}</td>
                    <td>{$u.realname}</td>
                    <td>{$u.headpicture}</td>
                </tr>
            </volist>
            <foreach name="data" item="u" key="i">
                <tr>
                    <td>{$i}</td>
                    <td>{$u.userid}</td>
                    <td>{$u.username}</td>
                    <td>{$u.userpass}</td>
                    <td>{$u.realname}</td>
                    <td>{$u.headpicture}</td>
                </tr>
            </foreach>
            <for start="0" end="$dataSize" comparison="lt" step="1" name="i">
            </for>
            -->
            <for start="$dataSize-1" end="0" comparison="egt" step="-1" name="i">
                <tr>
                    <td>{$i}</td>
                    <td>{$data[$i].userid}</td>
                    <td>{$data.$i.username}</td>
                    <td>{$data.$i.userpass}</td>
                    <td>{$data[$i].realname}</td>
                    <td>{$data[$i].headpicture}</td>
                </tr>
            </for>
        </table>
    </body>

</html>