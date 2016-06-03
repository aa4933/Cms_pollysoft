<?php
namespace  app\models;

use Yii;
use yii\base\Model;
use LeanCloud\ LeanClient;

class tool extends Model{
			
			function dump($vars, $label = '', $return = false) {//格式化数组
				header("Content-Type: text/html; charset=UTF-8");
				if (ini_get('html_errors')) {
					$content = "<pre>\n";
					if ($label != '') {
						$content .= "<strong>{$label} :</strong>\n";
					}
					$content .= htmlspecialchars(print_r($vars, true));
					$content .= "\n</pre>\n";
				} else {
					$content = $label . " :\n" . print_r($vars, true);
				}
				if ($return) { return $content; }
				return  $content;
				return null;
			}
			function object_array($array)//获取对象转换为数组
			{
				if(is_object($array))
				{
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
			function  vtime($time){//时间转换
				return date('Y-m-d H:i:s', strtotime($time));
			}
			function array_judge($arr){//数组维度判断
				$al = array(0);
				function aL($arr,&$al,$level=0){
					if(is_array($arr)){
						$level++;
						$al[] = $level;
						foreach($arr as $v){
							aL($v,$al,$level);
						}
					}
				}
				aL($arr,$al);
				return max($al);
			}
			function utctime() {
				return LeanClient::get("/date")['iso'];
			}
			public static  function  arrtime($objtime) {
				
			   $arr = get_object_vars($objtime);//转换一个时间对象
			   
			   $time = $arr['date'];
			   
			   return date('Y-m-d H:i:s', strtotime($time));
			    
			}
}