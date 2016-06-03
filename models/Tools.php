<?php
namespace app\models;
use Yii;
use yii\base\Model;
use LeanCloud\LeanQuery;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use LeanCloud\LeanClient;
use LeanCloud\LeanUser;
class Tools extends Model{
    /**
     * 把对象转换为数组
     * @param unknown $array
     * @return array
     */
function object_array($array)
{
    if(is_object($array))
    {
        //强制转换
        $array = (array)$array;
    }
    if(is_array($array))
    {
        foreach($array as $key=>$value)
        {
            $array[$key] = $this->object_array($value);
        }
    }
    return $array;
}
/**
 * 增加时间
 * 单位（天）
 * @param unknown $addTime
 */
function Time_add($addTime){
    $date=time();
    $Time=$date+$addTime*24*60*60;
    $isChangeTime=date('Y-m-d H:i:s',$Time);
    return $isChangeTime;
}
/**
 * 通过产品ID与能量站ID查找对应的记录
 * @param unknown $productId
 * @param unknown $providerId
 * @return Ambigous <multitype:, multitype:unknown >
 */
public function selectForavailable($productId,$providerId){
    $query=new LeanQuery('Inventory');
    $query->equalTo('productID', $productId);
    $query->equalTo('providerID', $providerId);
    $obj=$query->first();
    return $obj;
}
/**
 * 通过objID找到对应库存信息并修改
 * @param unknown $objectID
 * @param unknown $keep
 * @return multitype:
 */
public function updateAvailable($objectID,$keep){
    $query = new LeanQuery('Inventory');
    if ($keep==true) {
    $result= $query->doCloudQuery("update Inventory set available=1
            where objectId='".$objectID."'");
    }else {
    $result= $query->doCloudQuery("update Inventory set available=0
            where objectId='".$objectID."'");
    }
    return $result;
}
function myfunction($value,$key){
    var_dump($value);
    exit();
    $arr[$key]['name']=$value->get('name');
    $arr[$key]['objectId']=$value->get('objectId');
    // $arr[$i]['pic']=$object1[$i]->get('pic');
    $arr[$key]['createAt']=$value->get('createAt')['date'];
    $arr[$key]['expiredTime']=$value->get('expiredTime')['date'];
    $arr[$key]['status']=$value->get('status');
    $result=LeanQuery::doCloudQuery("select * from Inventory where productID='".$value->get('uid')."'");
    $arr[$key]['number']=count(current($result));
}
}