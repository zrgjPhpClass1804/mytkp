<?php
namespace Home\Controller;
use Think\Controller;
class PermissionController extends Controller {

    private $model;

    public function __construct(){
        $this->model = M("tb_role");
    }

    /**
     * 加载所有的角色列表
     */
    public function loadAllRoles(){
        echo json_encode($this->model->select());
    }
    
    /**
     * 加载用户角色，并且查询到该角色已有的用户 结果集第三列为1时表示属于当前角色
     */
    public function loadUserRoles(){
        $rid = $_GET["rid"];
        $sql = "select u.userid,u.realname,(select 1 from tb_userrole ur where ur.userid=u.userid and ur.roleid=%d) as checked from tb_user u";
        echo json_encode($this->model->query($sql, $rid));
    }

    /**
     * 编辑用户角色
     */
    public function editUserRole(){
        $rid = $_GET["rid"];
        //echo "{\"result\":\"$rid\"}";
        $userids = $_GET["userids"];
        //先删除该角色原有用户关联关系数据
        $this->model->table("tb_userrole")->where("roleid=%d", $rid)->delete();
        //再重新添加用户角色关联关系数据
        $userids = explode(",", $userids);
        foreach($userids as $userid){
            $this->model->table("tb_userrole")->field("roleid,userid")->add(array("roleid"=>$rid, "userid"=>$userid));
        }
        echo "{\"result\":\"ok\"}";
    }

   
}