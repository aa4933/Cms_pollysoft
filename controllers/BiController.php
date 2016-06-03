<?php

namespace app\controllers;

use LeanCloud\LeanClient;
use LeanCloud\LeanQuery;
use LeanCloud\LeanUser;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;

use LeanCloud\Storage\SessionStorage;
use app\models\tool;
use app\models\Bi;
use DateTime;

class BiController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
    	$bi=new bi();
    	$result=$bi->Login();//登陆
    	$arr1 = $bi->select(false,0,10);//m m+n
    	$arr2 = $bi->select(true,0,10);
    	return $this->render('index',array('arr1'=>$arr1,'arr2'=>$arr2));
    }
    public function actionCreate() {
    	$bi=new bi();
    	$bi->Login();//登陆
    	if (isset($_GET['create'])) {
            
    	    $objId=$bi->selectuid($_POST['uid']);
    	    
    	    if ($objId) {//有对应记录，执行修改操作
    	        
    	        $results=$bi->modify($_POST,$_FILES,$objId);
    	        
    	    }else {//无对应记录，执行添加操作
    	        
    	        $results=$bi->add($_POST,$_FILES);
    	        
    	    }

    		
    		if ($results){
    			echo "<script>alert('添加成功！！！');location.href=\"index.php?r=bi/index\";</script>";
    		}else {
    			echo "<script>alert('添加失败！！！');</script>";
    		}
    		

    	}
    	return $this->render('create');
    	}
    	public function actionModify(){
    		$bi=new bi();
    		$bi->Login();//登陆
    		
    		$objid=$_GET['objectId'];
    		
    		if (isset($_GET['modify'])) {
    		    
    			$results=$bi->modify($_POST,$_FILES,$objid);
        		if ($results){
        		    echo "<script>alert('修改成功！！！');location.href=\"index.php?r=bi/index\";</script>";
        		}else {
        		    echo "<script>alert('修改失败！！！');</script>";
        		}
    		}
    		
    		
    		$object=$bi->selectobjid($objid);
    		
    		$object->set('exhibitPics', $bi->exhibitPics($object->get('exhibitPics')));
    		
    		return $this->render('modify',array('obj'=>$object));
    	}
    	public function actionDelete(){
    	    $bi=new bi();
    		$bi->Login();//登陆
    	   
    	    $results=$bi->delete($_GET['objectId']);
    	    
    	    if ($results){
    	        echo "<script>alert('删除成功！！！');</script>";
    	    }else {
    	        echo "<script>alert('删除失败！！！');</script>";
    	    }
    	    
    	    return $this->render('delete');//删除操作完成
    	}
    public function actionView() {
        $bi = new Bi();
        $bi->Login();//登陆
        
        if (isset($_GET['objectId'])){
            
           $objId=$_GET['objectId'];
            
           $object=$bi->selectobjid($objId);
           
           $object->set('exhibitPics', $bi->exhibitPics($object->get('exhibitPics')));
           
           return $this->render('view',array('obj'=>$object));
        }else {
            return 0;
        }
        
    }
}
