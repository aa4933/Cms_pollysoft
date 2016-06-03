<?php

namespace app\controllers;

use LeanCloud\LeanClient;
use LeanCloud\LeanQuery;
use LeanCloud\LeanUser;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use app\models\Pi;
use app\models\Tools;
class PiController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //建立共同实例化的对象
        
        $pi=new Pi();
        $result=$pi->Login();
        $Tools=new Tools();
        //可兑的筛选
        $objects=$pi->isExchange(1);
        $isExchangeArr=$pi->select($objects);
        //不可兑的筛选
        $object1=$pi->isExchange(0);
        $arr=$pi->select($object1);
        //断点测试
        return $this->render('index',array('arr'=>$arr,'exchange'=>$isExchangeArr));
    }
    public function actionCreate(){
        //建立共同的实例化对象
        $pi=new Pi();
        $result=$pi->Login();
        if (isset($_GET['create'])) {
            $arr=array();
            $arr['uid']=$_POST['uid'];
            $arr['venderID']=$_POST['venderID'];
            $arr['name']=$_POST['name'];
            $arr['integral_need']=$_POST['integral_need'];
            $arr['price']=$_POST['price'];
            $arr['expiredTime']=$_POST['expiredTime'];
            $arr['url']=$_POST['url'];
            $arr['status']=$_POST['status'];
            $result2=$pi->add($arr,$_FILES);
            if ($result2){
                echo "<script>alert('添加成功！！！');location.href=\"index.php?r=pi/index\";</script>";
            }else {
                echo "<script>alert('添加失败！！！');</script>";
            }
        }
        return $this->render('create');
    }
    public function actionAlter(){
        //建立共同的实例化对象
        $pi=new Pi();
        $result=$pi->Login();
        if (isset($_GET['alter'])) {
            $arr=array();
            $arr['uid']=$_POST['uid'];
            $arr['venderID']=$_POST['venderID'];
            $arr['name']=$_POST['name'];
            $arr['integral_need']=$_POST['integral_need'];
            $arr['price']=$_POST['price'];
            //$arr['expiredTime']=$_POST['expiredTime'];
            $arr['url']=$_POST['url'];
            $arr['isDeleted']=$_POST['isDeleted'];
            $arr['status']=$_POST['status'];
            $result2=$pi->alter($arr,$_GET['objectId']);
            if ($result2){
                echo "<script>alert('修改成功！！！');location.href=\"index.php?r=pi/index\";</script>";
            }else {
                echo "<script>alert('修改失败！！！');</script>";
            }
        }
        //修改操作
        $objID=$_GET['objectId'];
        $object=$pi->selectByObjID($objID);
        return $this->render('alter',array('obj'=>$object));
    }
    public function actionRelation(){
        //建立共同的实例化对象
        $pi=new Pi();
        $result=$pi->Login();
        $Tools=new Tools();
        //获得当前选择修改的产品的基本信息
        $obj=$pi->selectByObjID($_GET['objectId']);
        //利用传来的能量站ID与产品ID共同筛选出需要修改状态的记录
        if (isset($_GET['keep'])) {
            $stateObj=$Tools->selectForavailable($obj->get('uid'), $_GET['providerID']);
            $objectId=$stateObj->getObjectId();
            if ($_POST['state']=='2') {
               $Tools->updateAvailable($objectId,true);
            }else {
               $Tools->updateAvailable($objectId,false);
            }
        }
        $arr=array(
          'name'=>$obj->get('name'),
          'createAt'=>$Tools->object_array($obj->get('createAt'))['date'],
          'expiredTime'=>$Tools->object_array($obj->get('expiredTime'))['date']  
        );
        //使用产品在关联表中找到对应的能量站ID，分离出已经删除的
        $object=$pi->selectByuid($obj->get('uid'));
        if (empty($object)) {
            return $this->render('empty');
        }
        $array=$pi->selectForesi($object);
        //这里必须筛选出可兑换与不可兑换的情况
        //筛选出未被删除而且可以兑换的能量站,使用分离list存储多个返回值
        list($arrayDeleted,$arrayNotdeleted)=$pi->separate($array);
        return $this->render('relation',array(
            'arr'=>$arr,
            'arrayDeleted'=>$arrayDeleted,
            'arrayNotdeleted'=>$arrayNotdeleted,
            'objectId'=>$_GET['objectId']
        ));
    }
    public function actionAddrelation(){
        //建立共同的实例化对象
        $pi=new Pi();
        $result=$pi->Login();
        $Tools=new Tools();
        //获得当前选择修改的产品的基本信息
        if (isset($_GET['alter'])) {
            $object=$Tools->selectForavailable($_GET['product'],$_GET['provider']);
            if ($_POST['state']=='2') {
                $Tools->updateAvailable($object->getObjectId(),true);
            }else {
                $Tools->updateAvailable($object->getObjectId(),false);
            }
        }
        $obj=$pi->selectByObjID($_GET['objectId']);
        //使用产品在关联表中找到对应的能量站ID，分离出已经删除的
        $arr=$pi->subquery($obj);
        return $this->render('selectEsi',array('arr'=>$arr,'objectId'=>$_GET['objectId'],'product'=>$obj->get('uid')));
    }
}
