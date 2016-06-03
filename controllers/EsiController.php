<?php
namespace app\controllers;
use LeanCloud\LeanClient;
use LeanCloud\LeanQuery;
use LeanCloud\LeanUser;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use app\models\Esi;
use app\models\Tools;
class EsiController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //建立共同实例化的对象
       $esi=new Esi();
       $result=$esi->Login();
        //已经删除的筛选
       $objects=$esi->isDelete(true);
       $isdeleteArr=$esi->select($objects);
        //未删除的筛选
        $object1=$esi->isDelete(false);
        $arr=$esi->select($object1);
        return $this->render('index',array('arr'=>$arr,'delete'=>$isdeleteArr));
    }
    public function actionCreate(){
        //建立共同实例化对象
        $esi=new Esi();
        $result=$esi->Login();
        //获取创建内容
        if (isset($_GET['create'])) {
          $arr=array();
            $arr['name']=$_POST['name'];
            $arr['cityCode']=$_POST['cityCode'];
            $arr['url']=$_POST['url'];
            $arr['telephone']=$_POST['telephone'];
            $arr['fax']=$_POST['fax'];
            $arr['landlineTel']=$_POST['landlineTel'];
            $arr['address']=$_POST['address'];
            $arr['regCode']=$_POST['regCode'];
            $arr['uid']=$_POST['uid'];
            $result2=$esi->add($arr);
            if ($result2){
                echo "<script>alert('添加成功！！！');location.href=\"index.php?r=esi/index\";</script>";
            }else {
                echo "<script>alert('添加失败！！！');</script>";
            }
        }
       return $this->render('create');
    }
    public function actionDelete(){
        //建立共同实例化对象
        $esi=new Esi();
        $result=$esi->Login();
        //删除操作
        $result2=$esi->delete($_GET['objectId']);
        //断点测试
        //var_dump($result2);
        return $this->render('delete');
    }
    public function actionAlter(){
        //建立共同实例化对象
        $query2 = new LeanQuery("Inventory");
        $esi=new Esi();
        $result=$esi->Login();
        //修改内容
        if (isset($_GET['alter'])) {
            $arr=array();
            $arr['name']=$_POST['name'];
            $arr['cityCode']=$_POST['cityCode'];
            $arr['url']=$_POST['url'];
            $arr['telephone']=$_POST['telephone'];
            $arr['fax']=$_POST['fax'];
            $arr['landlineTel']=$_POST['landlineTel'];
            $arr['address']=$_POST['address'];
            $arr['regCode']=$_POST['regCode'];
            $arr['uid']=$_POST['uid'];
            $cityCode=intval($arr['cityCode']);
            $result2=$esi->alter($arr,$_GET['objectId'],$cityCode);
        }
        //修改操作
        $objID=$_GET['objectId'];
        $object=$esi->selectByObjID($objID);
        return $this->render('alter',array('obj'=>$object));
    }
    public function actionRelation(){
        //建立共同的实例化对象
        $esi=new Esi();
        $result=$esi->Login();
        $Tools=new Tools();
        //通过OBJid筛选对应的能量站信息
        $obj=$esi->selectByObjID($_GET['objectId']);
        //利用传来的能量站ID与产品ID共同筛选出需要修改状态的记录
        if (isset($_GET['keep'])) {
            $stateObj=$Tools->selectForavailable($_GET['productID'],$obj->get('uid'));
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
          'address'=>$obj->get('address')  
        );
        //当出现能量站ID在库存表中没有字段的时候
        $object=$esi->selectByuid($obj->get('uid'));
        if (empty($object)) {
            return $this->render('empty');
        }
        //先筛选对应的产品内容
        $array=$esi->selectForPi($object);
        list($invalid,$uninvalid)=$esi->separate($array);
        return $this->render('relation',array(
            'arr'=>$arr,
            'invalid'=>$invalid,
            'uninvalid'=>$uninvalid,
            'objectId'=>$_GET['objectId']
        ));
    }
    public function actionAddrelation(){
        //建立共同的实例化对象
        $esi=new Esi();
        $result=$esi->Login();
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
        $obj=$esi->selectByObjID($_GET['objectId']);
        //使用能量站在关联表中找到对应的产品ID，分离出已经失效的
        $arr=$esi->subquery($obj);
        return $this->render('selectPi',array('arr'=>$arr,'objectId'=>$_GET['objectId'],'provider'=>$obj->get('uid')));
    }
}
