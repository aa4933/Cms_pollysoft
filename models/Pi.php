<?php
namespace app\models;
use Yii;
use yii\base\Model;
use LeanCloud\LeanQuery;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use LeanCloud\LeanClient;
use LeanCloud\LeanFile;
use app\models;
class Pi extends Model{
  /**
     * 登陆远程云服务器
     * @return unknown
     */
    public function Login(){
        $result=LeanClient::initialize();
        return $result;
    }
    /**
     * 增加方法
     * @param unknown $arr
     * @return boolean
     */
    public function add($arr,$file){
        $Tools=new Tools();
        //添加记录
        $obj = new LeanObject("Product");
        $newtime=new \DateTime();
        $time=$Tools->Time_add($arr['expiredTime']);
         $obj->set("uid",$arr['uid']);
         $obj->set("venderID", $arr['venderID']);
         $obj->set("name",$arr['name']);
         $obj->set("integral_need", intval($arr['integral_need']));
         $obj->set("price",intval($arr['price']));
         //图片读取设置
         $name= $file['pic']["name"];
         $fi=$file['pic']["tmp_name"];
         $ty=$file['pic']["type"];
         $data=  file_get_contents($fi);
         $fileobj = new LeanFile($name, $data, $ty);
         $obj->set("pic", $fileobj);
         
         $format='Y-m-d H:i:s';
         $obj->set("expiredTime",\DateTime::createFromFormat($format, $time));
         $obj->set("createAt", new \DateTime());
         $obj->set("url",$arr['url']);
         $obj->set("isDeleted",true);
         $obj->set("status",intval($arr['status']));
         //此处未写经度纬度获取
         try {
            $result=$obj->save();
            return true;
         } catch (CloudException $ex) {
             var_dump($ex);
             return false;
         // CloudException 会被抛出，如果保存失败
         }
    }
    /**
     * 找到对应的数列并排序
     * @param unknown $exchange
     * @return Ambigous <multitype:, multitype:unknown >
     */
    public function isExchange($exchange){
        $query3 = new LeanQuery("Product");
        $query3->equalTo('status',$exchange);
        $query3->addDescend("createAt");
        $objects = $query3->find();
        return $objects;
    }
    /**
     * 查询方法
     * @param unknown $object1
     * @param unknown $query2
     * @return Ambigous <multitype:multitype: , string, number>
     */
    public function select($object1){
        //循环遍历
        $query = new LeanQuery("Inventory");
        $res2=$query->find();
        $tools=new Tools();
        //建立二维数组存储
        $arr=array(array());
        foreach ($object1 as $key=>$value){
            $i=0;
            $arr[$key]['name']=$value->get('name');
            $arr[$key]['pic']=$value->get('pic');
            $arr[$key]['objectId']=$value->get('objectId');
            $arr[$key]['status']=$value->get('status');
            $arr[$key]['createAt']=$tools->object_array($value->get('createAt'))['date'];
            $arr[$key]['expiredTime']=$tools->object_array($value->get('expiredTime'))['date'];
            $cnt=$value->get('uid');
            foreach ($res2 as $value) {
                if ($value->get("productID")==$cnt) {
                    $i++;
                };
            }
            $arr[$key]['number']=$i;
        }
        return $arr;
    }
    /**
     * 使用产品ID找到对应的能量站ID并对能量站表进行读取筛选出已经被删除的
     * @param unknown $object
     * @return Ambigous <multitype:multitype: , string, \LeanCloud\mixed, NULL, multitype:, \LeanCloud\LeanRelation>
     */
    public function selectForesi($object){
        $tools=new Tools();
        $query2 = new LeanQuery("Provider");
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
            $query2->equalTo('uid', $arr[$i]['providerID']);
            try {
                $object2= $query2->first();
                $arr[$i]['isDeleted']=$object2->get('isDeleted');
            } catch (CloudException $e) {
                $arr[$i]['isDeleted']="未获取到能量站删除标记";
            }
        
        }
        return $arr;
        
    }
    /**
     * 通过OBJID查找对应的记录
     * @param unknown $objectId
     * @return \LeanCloud\LeanObject
     */
    public function selectByObjID($objectId){
        $query = new LeanQuery("Product");
        $query->equalTo('objectId', $objectId);
        $object=$query->first();
        return $object;
    }
    /**
     * 通过产品UID查找到对应的能量站ID
     */
    public function selectByuid($uid){
        $query = new LeanQuery("Inventory");
        $query->equalTo('productID', $uid);
        $obj=$query->find();
        return $obj;
    }
    /**
     * 修改操作
     * @param unknown $arr
     * @param unknown $objID
     * @return multitype:
     */
    public function alter($arr,$objID){
        $query = new LeanQuery("Product");
        $result= $query->doCloudQuery("update Product set uid='".$arr['uid']."',
            venderID='".$arr['venderID']."',
            name='".$arr['name']."',
            integral_need=".intval($arr['integral_need']).",
            price=".intval($arr['price']).",
            url='".$arr['url']."',
           isDeleted=".boolval($arr['isDeleted']).",
           status=".intval($arr['status'])."
            where objectId='".$objID."'");
        return $result;
    }
    /**
     * 把已删除与未删除的筛选出来组成数组，实现返回多个数
     * @param unknown $array
     */
    public function separate($array){
        $arrayDeleted=array();
        $arrayNotdeleted=array();
        foreach ($array as $key=>$value){
            if ($value['available']==true) {
                if ($value['isDeleted']==false) {
                    $arrayNotdeleted[$key]['providerID']=$value['providerID'];
                    $arrayNotdeleted[$key]['available']='可兑换';
                }else {
                    $arrayDeleted[$key]['providerID']=$value['providerID'];
                    $arrayDeleted[$key]['available']='可兑换';
                }
            }
        }
        $separate=array(
          '0'=>$arrayDeleted,
          '1'=>$arrayNotdeleted 
        );
        return $separate;
    }
    /**
     * 我们拿到产品的ID以后，通过子查询进行多表关联查询
     * @param unknown $obj
     */
    public function subquery($obj){
        $Tools=new Tools();
        $result=LeanQuery::doCloudQuery("
            select * from Provider where 
            isDeleted=false and
            uid =(select providerID from Inventory where available=false and productID='".$obj->get('uid')."')
            ");
        $array=$Tools->object_array($result);
        $arr=array();
        foreach ($array['results'] as $key=>$value){
            $arr[current($value)['objectId']]['name']=current($value)['name'];
            $arr[current($value)['objectId']]['uid']=current($value)['uid'];
        }
        return $arr;
    }
}