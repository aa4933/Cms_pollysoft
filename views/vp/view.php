<?php
use app\models\tool;
/* @var $this yii\web\View */

?>
<a class='btn btn-default' href="index.php?r=vp/index">返回</a>
<p>
<h1>详细信息</h1>
 产品ID：<?php echo $obj->get('uid');?><br><br>
 厂商ID：<?php echo $obj->get('venderID');?><br><br>
 名字：<?php echo $obj->get('name');?><br><br>
 图片：<img src="<?php echo $obj->get('pic')->get('url');?>" alt="" /  ><br><br>
 需要积分：<?php echo $obj->get('integral_need');?><br><br>
 价格：<?php echo $obj->get('price');?><br><br>
 有效期：<?php echo tool::arrtime($obj->get('expiredTime'));?><br><br>
 链接：<?php echo $obj->get('url')?><br> <br> 
 录入时间:<?php echo tool::arrtime($obj->get('createAt'));?><br>  <br>
 
 删除标记：<?php echo  $obj->get('isDeleted')?"已被删除":"未被删除";?><br>  <br>
 
 可兑状态：<?php echo $obj->get('status')?"可兑":"不可兑";?><br>  <br>

<a  class='btn btn-default' href="index.php?r=vp/modify&objectId=<?php echo $obj->get('objectId');?>">修改</a><br/>

   
</p>