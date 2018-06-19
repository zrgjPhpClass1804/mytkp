<?php 
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class UserController extends Controller{

    private $model;

    public function __construct(){
        $this->model = M("tb_user");
    }

    /**
     * 用户登录
     */
    public function login($userName=null, $userPass=null){
        //$userName = $_POST["userName"];
        //$userPass = $_POST["userPass"];
        //$userName = I("userName");
        //echo "$userName, $userPass";
        $data = $this->model->where("userName='%s'", $userName)->select();
        if(count($data) > 0){
            if($data[0]["userpass"] == $userPass){
                session("user", $data[0]);
                /**
                 * 权限管理-利用当前登录用户id去查询该用户拥有的菜单权限
                 */ 
                $sql = "select distinct m.* from tb_userrole ur, tb_rolemenu rm, tb_menu m where ur.userid=%d and ur.roleid=rm.roleid and rm.menuid=m.mid and m.isHomePage=1";
                $menus = $this->model->query($sql, $data[0]["userid"]);
                session("menus", $menus);
                header("location:".ROOT."Public/bootstrap/admin.php");
                //$this->redirect("/Home/User/jump");
                //redirect("/tp2/index.php/Home/User/jump");
            }else{
                $msg = 2;//密码错误
                session("msg", $msg);
                header("location:".ROOT."login.php");
            }
        }else{
            $msg = 3;//用户名不存在
            session("msg", $msg);
            header("location:".ROOT."login.php");
        }
    }

    public function setHeadPicture(){
        $up = new Upload(array(
            'maxSize' => 3145728,
            'rootPath'=> 'Public/upload/',
            'saveName'=> rand(1, 100000) . "" . time(),
            'exts'    => array('jpg','jpeg','png','gif'),
            'autoSub' => false
        ));
        $info = $up->upload();
        //var_dump($info);
        if($info){
            //将头像文件路径修改到当前用户的头像列中
            $user = session("user");
            $user["headpicture"] = "../upload/" . $info["headPicture"]["savename"];
            session("user", $user);
            $this->model->data($user)->field("userid,headpicture")->save();
            echo "<script type='text/javascript'>window.top.location.href = '".ROOT."Public/bootstrap/admin.php';</script>";
        }else{
            echo "<script type='text/javascript'>alert('头像设置失败！');</script>";
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