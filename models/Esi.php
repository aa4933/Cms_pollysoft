<?php
namespace app\models;
use Yii;
use yii\base\Model;
use LeanCloud\LeanQuery;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use LeanCloud\LeanClient;
use LeanCloud\LeanUser;
class Esi extends Model{
    /**
     * 登陆远程云服务器
     * @return unknown
     */
    public function Login(){
        $result=LeanClient::initialize();
        return $result;
    }
    /**
     * 循环遍历查询能量站
     * @param unknown $object1
     * @param unknown $query2
     * @return Ambigous <multitype:multitype: , string>
     */
    public function select($object1){
        //建立二维数组存储
        $query = new LeanQuery("Inventory");
        $res2=$query->find();
        $Tools=new Tools();
        $arr=array(array());
        $count=count($object1);
        //循环遍历
        for ($i=0;$i<$count;$i++){
            $arr[$i]['name']=$object1[$i]->get('name');
            $arr[$i]['address']=$object1[$i]->get('address');
            $date=$Tools->object_array($object1[$i]->get('createAt'));
            $arr[$i]['createAt']=$date['date'];
            $arr[$i]['regCode']=$object1[$i]->get('regCode');
            $arr[$i]['uid']=$object1[$i]->get('uid');
            $arr[$i]['objectId']=$object1[$i]->get('objectId');
            $cnt=$arr[$i]['uid'];
            foreach ($res2 as $value){
                if($value->get("providerID")==$cnt){
                   $arr[$i]['stock']=$value->get('stock');
                }
            }
        }
        return $arr;
    }
    /**
     * 增加能量站
     * @param unknown $arr
     * @return boolean
     */
    public function add($arr){
        
        //添加记录
         $obj = new LeanObject("Provider");
         $obj->set("cityCode",intval($arr['cityCode']));
         $obj->set("name", $arr['name']);
         $obj->set("url",$arr['url']);
         $obj->set("telephone", $arr['telephone']);
         $obj->set("fax",$arr['fax']);
         $obj->set("landlineTel",$arr['landlineTel']);
         $obj->set("createAt", new \DateTime());
         $obj->set("address",$arr['address']);
         $obj->set("regCode", $arr['regCode']);
         $obj->set("uid",$arr['uid']);
         //此处未写经度纬度获取
         try {
            $result=$obj->save();
            var_dump($result);
            return true;
         } catch (CloudException $ex) {
             var_dump($ex);
             return false;
         // CloudException 会被抛出，如果保存失败
         }
    }
    /**
     * 判断整个模块是否被删除
     * @param unknown $delete
     * @return Ambigous <multitype:, multitype:unknown >
     */
    public function isDelete($delete){
        $query3 = new LeanQuery("Provider");
        $query3->equalTo('isDeleted',$delete);
        $query3->addDescend("createAt");
        $objects = $query3->find();
        return $objects;
    }
    /**
     * 删除操作
     * @param unknown $objectId
     * @return multitype:
     */
    public function delete($objectId){
        $query = new LeanQuery("Provider");
        /* $query->equalTo('uid',$uid);
        $obj=$query->find();
        $result3=$obj->destroy();
        return $result3; */
       $result= $query->doCloudQuery("update Provider set isDeleted=true where objectId='".$objectId."'");
        return $result;
    }
    /**
     * 通过OBJID查找对应的记录
     * @param unknown $objectId
     * @return \LeanCloud\LeanObject
     */
    public function selectByObjID($objectId){
        $query = new LeanQuery("Provider");
        $query->equalTo('objectId', $objectId);
        $object=$query->first();
        return $object;
    }
    /**
     * 修改操作
     * @param unknown $arr
     * @param unknown $objId
     * @param unknown $cityCode
     * @return multitype:
     */
    public function alter($arr,$objId,$cityCode){
        $query = new LeanQuery("Provider");
        $result= $query->doCloudQuery("update Provider set name='".$arr['name']."',
            cityCode=".$cityCode.",
            url='".$arr['url']."',
            telephone='".$arr['telephone']."',
            fax='".$arr['fax']."',
            landlineTel='".$arr['landlineTel']."',
            address='".$arr['address']."',
            regCode='".$arr['regCode']."',
            uid='".$arr['uid']."'
            where objectId='".$objId."'");
        return $result;
    }
    /**
     * 通过能量站UID查找到对应的产品ID
     */
    public function selectByuid($uid){
        $query = new LeanQuery("Inventory");
        $query->equalTo('providerID', $uid);
        $obj=$query->find();
        return $obj;
    }
    /**
     * 使用能量站ID找到对应的产品ID并对产品表进行读取并组成过期时间
     * @param unknown $object
     * @return Ambigous <multitype:multitype: , string, \LeanCloud\mixed, NULL, multitype:, \LeanCloud\LeanRelation>
     */
    public function selectForPi($object){
        $tools=new Tools();
        $query2 = new LeanQuery("Product");
        //建立二维数组存储
        $arr=array(
            array(
    
            )
        );
        //循环遍历
        for ($i=0;$i<count($object);$i++){
            $arr[$i]['productID']=$object[$i]->get('productID');
            $arr[$i]['providerID']=$object[$i]->get('providerID');
            $arr[$i]['stock']=$object[$i]->get('stock');
            $arr[$i]['available']=$object[$i]->get('available');
            $query2->equalTo('uid', $arr[$i]['productID']);
            try {
                $object2= $query2->first();
                $expiredTime=$tools->object_array($object2->get('expiredTime'))['date'];
                $endtime=strtotime($expiredTime);
                $now=strtotime('now');
                if ($endtime>$now) {
                    //当结束时间戳大于现在的时间，说明未过期
                    $arr[$i]['overdue']=false;
                }else {
                    //当结束时间戳小于或者等于现在的时间，说明已过期
                    $arr[$i]['overdue']=true;
                }
            } catch (CloudException $e) {
                $arr[$i]['overdue']="未能成功计算过期日期";
            }
    
        }
        return $arr;
    
    }
    /**
     * 把未失效和已失效的筛选出来组成数组，实现返回多个数
     * @param unknown $array
     */
    public function separate($array){
        $invalid=array();//已经失效
        $uninvalid=array();//未失效
        foreach ($array as $key=>$value){
            if ($value['available']==true) {
                if ($value['overdue']==false) {
                    $uninvalid[$key]['productID']=$value['productID'];
                    $uninvalid[$key]['available']='可兑换';
                }else {
                    $invalid[$key]['productID']=$value['productID'];
                    $invalid[$key]['available']='可兑换';
                }
            }
        }
        $separate=array(
            '0'=>$invalid,
            '1'=>$uninvalid
        );
        return $separate;
    }
    /**
     * 我们拿到能量站的ID以后，通过子查询进行多表关联查询
     * @param unknown $obj
     */
    public function subquery($obj){
        $Tools=new Tools();
        $query2 = new LeanQuery("Product");
        $productID=LeanQuery::doCloudQuery("select productID from Inventory where available=false and providerID='".$obj->get('uid')."'");
        $array=$Tools->object_array($productID);
        $arr=array();
        foreach ($array['results'] as $key=>$value){
            $query2->equalTo('uid',current($value)['productID']);
            $object2= $query2->first();
            $expiredTime=$Tools->object_array($object2->get('expiredTime'))['date'];
            $endtime=strtotime($expiredTime);
            $now=strtotime('now');
            if ($endtime>$now) {
            //当结束时间戳大于现在的时间，说明未过期
            $arr[current($value)['objectId']]['time']=false;
            $arr[current($value)['objectId']]['productID']=current($value)['productID'];
            $arr[current($value)['objectId']]['name']=$object2->get('name');
            }
        return $arr;
    }
 }
}