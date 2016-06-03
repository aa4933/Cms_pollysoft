<?php
namespace app\models;
use Yii;
use yii\base\Model;
use LeanCloud\LeanQuery;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
use LeanCloud\LeanClient;
use LeanCloud\LeanUser;
use LeanCloud\LeanFile;
use DateTime;
class Vp extends Model{
    /**
     * 登陆远程云服务器
     * @return unknown
     */
    public function Login(){
        $result=LeanClient::initialize();
        return $result;
    }
    /**
     * 循环遍历查询虚拟产品
     * @param unknown $object1
     * @return Ambigous <multitype:multitype: , string>
     */
   public function selectTime($del,$skip,$limit){
    	
        //$object = new LeanQuery("Product");
         /* $time = LeanClient::get("/date")['iso'];
            
        if ($del){
        	    
        	$cql="select * from Product where expiredTime > date('$time') limit ?,? order by createAt desc";
        	
        		
        }else {
        	
        	$cql="select * from Product where expiredTime <= date('$time') limit ?,? order by createAt desc";
 
        }
        
        $results=LeanQuery::doCloudQuery($cql,array($site,$num));  */
      
        //$results= LeanClient::encode($results);

       $query = new LeanQuery("Product");

       if ($del) {
           $query->greaterThan("expiredTime", new \DateTime());
       }else {
           $query->lessThanOrEqualTo("expiredTime", new \DateTime());
       }

        $query->limit($limit);
        
        $query->skip($skip);
        
        $query->addDescend("createAt");
        
        /* $object2 = new LeanQuery("Product");
        $object2->lessThanOrEqualTo("expiredTime", new \DateTime());
        
        $object2->addDescend("createdAt"); */

        
        // $object = LeanQuery::orQuery($object1, $object2);//组合查询
        
        //$results = $object2->find();

        //current($object1[$i]);
        
        
        return $query->find();
        
   }
    
    
    
    
    public function select($object1){
    	
        //建立数组存储
        $obj = new tool();
        
		$arr = array(array());
		$res = array(array()); 
        
        for ($i=0;$i<count($object1);$i++){
        	
        	$res =current($object1[$i]);//读取第一个数组
        	
        	foreach ($res as $key => $val){
        		
        		if (is_array($val)){//判断数组成员是否为数组
        			$arr[$i][$key]=date('Y-m-d H:i:s', strtotime($res[$key]['date']));//获取对象数组中的时间，并格式化
        		}else {
        			$arr[$i][$key] = $val;
        		}
        		
        	}	
        	
//             $arr[$i]['uid']=$object1[$i]->get('uid');
//             $arr[$i]['name']=$object1[$i]->get('name');
//             $arr[$i]['integral_need']=$object1[$i]->get('integral_need');
//             $arr[$i]['price']=$object1[$i]->get('price');
//             $arr[$i]['expiredTime']=$object1[$i]->get('expiredTime');
//             $arr[$i]['url']=$object1[$i]->get('url');
//             $arr[$i]['createAt']=$object1[$i]->get('createAt');
//             $arr[$i]['status']=$object1[$i]->get('status');
//             $arr[$i]['objectId']=$object1[$i]->get('objectId'); 
       }
        
        return $arr;
    }
    /**
     * 增加虚拟产品
     * @param unknown $arr
     * @return boolean
     */
    public function add($arr,$file){
        
        //添加记录
         $obj = new LeanObject("Product");
         $obj->set("uid",$arr['uid']);
         $obj->set("venderID", $arr['venderID']);
         $obj->set("name",$arr['name']);
         
         $name= $file['pic']["name"];
         $fi=$file['pic']["tmp_name"];
         $ty=$file['pic']["type"];
         $data=  file_get_contents($fi);
         $fileobj = new LeanFile($name, $data, $ty);
         $obj->set("pic", $fileobj);
         
         $obj->set("integral_need", intval($arr['integral_need']));
         $obj->set("price",floatval($arr['price']));
         
         $format = 'Y-m-d H:i:s';
         $time = $arr['expiredTime']." 08:00:00";//零点
         $date = DateTime::createFromFormat($format, $time);
         
         $obj->set("expiredTime", $date);
         $obj->set("url", $arr['url']);
         $obj->set("createAt",new \DateTime());
         
         $obj->set("status", intval($arr['status']));
         
         try {
         	$obj->save();
         	return true;
         } catch (CloudException $ex) {
         	// CloudException 会被抛出，如果保存失败
            return false;
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
        $query = new LeanQuery("Product");
        $query->equalTo('objectId', $objectId);
        $object=$query->first();
        return $object;
    }
    public function modify($arr,$file,$date){
//     	$obj="Product";
    	
//     	$arr=array();
// //     		$arr['uid']=$_POST['uid'];
// //     		$arr['venderID']=$_POST['venderID'];
// //     		$arr['name']=$_POST['name'];

//         	$arr['pic']=$_FILES["pic"]; //图片

//         	$name= $arr['pic']["name"];
//         	$fi=$arr['pic']["tmp_name"];
//         	$ty=$arr['pic']["type"];
//         	$data= file_get_contents($fi);
        	
//         	$arr['pic'] = new LeanFile($name, $data, $ty);

//     		$arr['integral_need']=intval($_POST['integral_need']);
    		
//     		$arr['price']=floatval($_POST['price']);
    		
//     		$format = 'Y-m-d H:i:s';
    		
//     		$time =date("Y-m-d\TH:i:s.u",strtotime($_POST['expiredTime']))." 08:00:00";//零点
    		
//     		$time = substr($time, 0, 23) . "Z";

// //      	$objtime=\DateTime::createFromFormat($format, $time);
    		
//     		/* $arr['expiredTime']=date("Y-m-d H:i:s",strtotime($_POST['expiredTime']));
//     		\DateTime::createFromFormat($format, $time, $object) */
// //     		date_format($arr['expiredTime'], 'Y-m-d');
	
//      		/* $iso = $utc->format("Y-m-d\TH:i:s.u");
//      		// PHP does not support sub seconds well, it will always gives 6 zero
//      		// digits as microseconds. We chop 3 zeros off:
//      		//  `2015-09-18T08:06:20.000000Z` -> `2015-09-18T08:06:20.000Z`
//      		$iso = substr($iso, 0, 23) . "Z"; */

//     		$arr['expiredTime'] = array("__type" => "Date",
//     		        "iso" => $time);
    		
    		
//     		$arr['pic']=array("__type"    => "File",
//     		        "name"      => "$name",
//     		        "content"  => $data,
//     		        "mimeType" => $ty);
    		
// //     		var_dump($arr['pic']);
// //     		exit();
    		
// //     		$arr['url']=$_POST['url'];
//     		$arr['status']=intval($_POST['status']);
    	
//     		$file = LeanFile::createWithLocalFile("/tmp/myfile.png");
    	
//     	$result=LeanClient::put("/classes/{$obj}/{$date}",$arr);
        $obj = new LeanObject("Product",$date);
        $obj->set("uid",$arr['uid']);
        $obj->set("venderID", $arr['venderID']);
        $obj->set("name",$arr['name']);
        
        if ($file['error']==0) {
            $name= $file["name"];
            $fi=$file["tmp_name"];
            $ty=$file["type"];
            $data=  file_get_contents($fi);
            $file = new LeanFile($name, $data, $ty);
            $obj->set("pic", $file);
        }

        $obj->set("integral_need", intval($arr['integral_need']));
        $obj->set("price",floatval($arr['price']));
         
        $format = 'Y-m-d H:i:s';
        
        $time = date("Y-m-d",strtotime($arr['expiredTime']))." 08:00:00";//零点
        $date = DateTime::createFromFormat($format, $time);
         
        $obj->set("expiredTime", $date);
        $obj->set("url", $arr['url']);
        $obj->set("createAt",new \DateTime());
         
        $obj->set("status", intval($arr['status']));
         
        try {
            $obj->save();
            return true;
        } catch (CloudException $ex) {
            // CloudException 会被抛出，如果保存失败
            return false;
        }
         
        }
    
}