<?php 
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{

    private $model;

    public function __construct(){
        $this->model = M("tb_user");
    }

    /**
     * 用户登录
     */
    public function login(){
        $userName = $_POST["userName"];
        $userPass = $_POST["userPass"];

        $data = $this->model->where("userName='%s'", $userName)->select();
        if(count($data) > 0){
            if($data[0]["userpass"] == $userPass){
                $_SESSION["user"] = $data[0];
                /**
                 * 权限管理-利用当前登录用户id去查询该用户拥有的菜单权限
                 */ 
                $sql = "select distinct m.* from tb_userrole ur, tb_rolemenu rm, tb_menu m where ur.userid=%d and ur.roleid=rm.roleid and rm.menuid=m.mid and m.isHomePage=1";
                $menus = $this->model->query($sql, $data[0]["userid"]);
                $_SESSION["menus"] = $menus;
                header("location:".ROOT."Public/bootstrap/admin.php");
            }else{
                $msg = 2;//密码错误
                $_SESSION["msg"] = $msg;
                header("location:".ROOT."login.php");
            }
        }else{
            $msg = 3;//用户名不存在
            $_SESSION["msg"] = $msg;
            header("location:".ROOT."login.php");
        }
    }

    /**
     * 用户退出
     */
    public function logout(){
        session_destroy();
        header("location:".ROOT."login.php");
    }

}