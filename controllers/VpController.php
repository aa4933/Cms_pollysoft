<?php

namespace app\controllers;

use LeanCloud\LeanClient;
use LeanCloud\LeanQuery;
use LeanCloud\LeanUser;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;

use LeanCloud\Storage\SessionStorage;
use app\models\tool;
use app\models\Vp;
use DateTime;

class VpController extends \yii\web\Controller
{
	public $enableCsrfValidation = false;
    
    public function actionIndex()
    {
    	//建立共同实例化的对象
    	$query2 = new LeanQuery("Product");
    	$vp=new vp();
    	$vp->Login();//登陆
    	$arr1 =  $vp->selectTime(true,0,10);//bool,int,int  获取有效列表
    	$arr2 =  $vp->selectTime(false,0,10);//获取无效列表
    	return $this->render('index',array('arr1'=>$arr1,'arr2'=>$arr2));
    }
    
    public function actionCreate(){
    	$vp=new vp();
    	$tool = new tool();
    	$result=$vp->Login();//登陆服务器
    	//获取创建内容
    	if (isset($_GET['create'])) {
    		$results=$vp->add($_POST,$_FILES);
    	    if ($results){
    			echo "<script>alert('添加成功！！！');location.href=\"index.php?r=vp/index\";</script>";
    		}else {
    			echo "<script>alert('添加失败！！！');</script>";
    		}

    	}
    	return $this->render('create');
    }
    public function actionModify(){
    	$vp=new vp();
    	$result=$vp->Login();
    	//修改内容
    	if (isset($_GET['modify'])) {
    		$results=$vp->modify($_POST,$_FILES["pic"],$_GET['objectId']);
    		if ($results){
    		    echo "<script>alert('修改成功！！！');location.href=\"index.php?r=vp/index\";</script>";
    		}else {
    		    echo "<script>alert('修改失败！！！');</script>";
    		}
    	}
    	//修改操作
    	$objID=$_GET['objectId'];
    	$object=$vp->selectByObjID($objID);
    	return $this->render('modify',array('obj'=>$object));
    }
    public function actionView() {
        $vp = new Vp();
        $vp->Login();//登陆
        
        if (isset($_GET['objectId'])){
            
           $objId=$_GET['objectId'];
            
           $object = $vp->selectByObjID($objId);
           
           return $this->render('view',array('obj'=>$object));
        }else {
            return 0;
        }
        
    }
    
    
}
