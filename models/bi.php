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
class bi extends Model{
  /**
     * 登陆远程云服务器
     * @return unknown
     */
    public function Login(){
        $result=LeanClient::initialize();
        return $result;
    }
    public function select($val,$skip,$limit) {//查询列表
    	
    	$query = new LeanQuery("Vender");
			
		$query->equalTo("isDeleted", $val);
		
		$query->limit($limit);
		
		$query->skip($skip);
		
		$query->addDescend("createdAt");

		return $query->find();
    }
    public function selectuid($uid) {
        
        $query = new LeanQuery("Vender");
        	
        $query->equalTo("uid", $uid);
        $res = $query->find();
        
        if (!empty($res)) {
            
            return  $res[0]->get('objectId'); //返回记录id

        }else {
            
            return  false;
            
        }

    }
    public function add($arr,$file) {//添加数据
        
        
        //添加记录
        $obj = new LeanObject("Vender");
        $obj->set("uid",$arr['uid']);
        $obj->set("name", $arr['name']);
        $obj->set("orgCode",$arr['orgCode']);
        $obj->set("desc",$arr['desc']);
        
        
        $format = 'Y-m-d H:i:s';
        $time = $arr['setupTime']." 08:00:00";//零点
        $date = \DateTime::createFromFormat($format, $time);
         
        $obj->set("setupTime", $date);
        /*
         * 
         * 展示图
         */
        
        foreach ($file['exhibitPics']['error'] as $key => $val) {
            if (!$val) {
                $name= $file['exhibitPics']["name"][$key];
                $fi=$file['exhibitPics']["tmp_name"][$key];
                $ty=$file['exhibitPics']["type"][$key];
                $data=  file_get_contents($fi);
                $arrfile[$key] = new LeanFile($name, $data, $ty);
            }
        }
        $obj->set("exhibitPics", $arrfile);
        
        

        $name= $file['logo']["name"];
        $fi=$file['logo']["tmp_name"];
        $ty=$file['logo']["type"];
        $data=  file_get_contents($fi);
        $fileobj = new LeanFile($name, $data, $ty);
        $obj->set("logo", $fileobj);
        
        $obj->set("url",$arr['url']);
        $obj->set("telephone",$arr['telephone']);
        $obj->set("fax",$arr['fax']);
        $obj->set("landlineTel",$arr['landlineTel']);
        $obj->set("address",$arr['address']);
        $obj->set("createAt",new \DateTime());
         
        try {
            $obj->save();
            return true;
        } catch (CloudException $ex) {
            // CloudException 会被抛出，如果保存失败
            return false;
        }
        

    	
    	/* 
    	 * post方式添加数据
    	$obj ="Vender";
    	
    	try {
    		LeanClient::post("/classes/{$obj}",$arr);
    		return true;
    	} catch (Exception $e) {
    		return false;
    	} */
    }
    
    public function selectobjid($objectId){//修改前的查询操作
    	
    	$query = new LeanQuery("Vender");
    	
    	$query->equalTo('objectId', $objectId);
    	
    	return $query->first();
    }
    public function exhibitPics($obj) {
        $arr=array();
        foreach ($obj as $value) {
            $objId=$value->get('objectId');
            $url=LeanFile::fetch($objId)->get('url');
            $arr[]=$url;
        };
        return $arr;
    }
    
    public function modify($arr,$file,$objId) {//添加
    	
        //修改记录
        $obj = new LeanObject("Vender",$objId);
        
        $obj->set("uid",$arr['uid']);
        $obj->set("name", $arr['name']);
        $obj->set("orgCode",$arr['orgCode']);
        $obj->set("desc",$arr['desc']);
        
        
        $format = 'Y-m-d H:i:s';
        
        $time = date("Y-m-d",strtotime($arr['setupTime']))." 08:00:00";//零点
        $date = \DateTime::createFromFormat($format, $time);
         
        $obj->set("setupTime", $date);
        
       
        foreach ($file['exhibitPics']['error'] as $key => $val) {
            if (!$val) {
                $name= $file['exhibitPics']["name"][$key];
                $fi=$file['exhibitPics']["tmp_name"][$key];
                $ty=$file['exhibitPics']["type"][$key];
                $data=  file_get_contents($fi);
                $arrfile[$key] = new LeanFile($name, $data, $ty);
            }
        }
        
        if (isset($arrfile)) {
            $obj->set("exhibitPics", $arrfile);
        }

        if (!$file['logo']['error']) {
            $name= $file['logo']["name"];
            $fi=$file['logo']["tmp_name"];
            $ty=$file['logo']["type"];
            $data=  file_get_contents($fi);
            $fileobj = new LeanFile($name, $data, $ty);
            $obj->set("logo", $fileobj);
        }
        

        $obj->set("url",$arr['url']);
        $obj->set("telephone",$arr['telephone']);
        $obj->set("fax",$arr['fax']);
        $obj->set("landlineTel",$arr['landlineTel']);
        $obj->set("address",$arr['address']);
        //$obj->set("createAt",new \DateTime());录入时间
        
         if (isset($arr['isDeleted'])) {//添加有重复记录时
             $obj->set("isDeleted",$arr['isDeleted']?false:true);
         }else {
             $obj->set("isDeleted",false);//没删除
         }
        
        
        try {
            $obj->save();
            return true;
        } catch (CloudException $ex) {
            // CloudException 会被抛出，如果保存失败
            return false;
        }
    	
    	
    	
    	/*   
    	 *   put方式修改数据    
    	$obj="Vender";
    	
    	try {
    		LeanClient::put("/classes/{$obj}/{$date}",$arr);
    		return true;
    	} catch (Exception $e) {
    		return false;
    	} */
    
    }
    public function delete($date) {//修改删除标记操作
        $obj="Vender";
    	
    	try {
    		LeanClient::put("/classes/{$obj}/{$date}",array('isDeleted'=>true));
    		return true;
    	} catch (Exception $e) {
    		return false;
    	}
    }
}