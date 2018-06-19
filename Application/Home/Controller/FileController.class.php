<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class FileController extends Controller {

    private $model;

    public function __construct(){
        parent::__construct();
        //$this->model = M("tb_user");
    }
    
    
    public function fileUpload(){
        $up = new Upload(array(
            'maxSize' => 1024*1024*1024,
            'rootPath'=> 'Public/upload2/',
            'saveName'=> rand(1, 100000) . "" . time(),
            //'exts'    => array('jpg','jpeg','png','gif'),
            'autoSub' => false
        ));
        $info = $up->upload();
        //var_dump($info);
        if($info){
            //将头像文件路径修改到当前用户的头像列中
            // $user = session("user");
            // $user["headpicture"] = "../upload/" . $info["headPicture"]["savename"];
            // session("user", $user);
            // $this->model->data($user)->field("userid,headpicture")->save();
            // echo "<script type='text/javascript'>window.top.location.href = '".ROOT."Public/bootstrap/admin.php';</script>";
            echo "Public/upload2/" . $info["fileList"]["savename"];
        }else{
            // echo "<script type='text/javascript'>alert('头像设置失败！');</script>";
            echo "上传失败！";
        }
        

    }




    

   
}