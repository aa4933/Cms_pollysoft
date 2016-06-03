<?php
use app\models\tool;
/* @var $this yii\web\View */

?>
<script type="text/javascript" src="js/showdate.js"></script>
<a class='btn btn-default' href="index.php?r=vp/index">返回</a>
<p>
<h1>商品修改</h1>
<form action="index.php?r=vp/modify&modify=true&objectId=<?php echo $obj->get('objectId') ?>" method="post" enctype="multipart/form-data">
 产品ID：<input class='form-control' type="text"   name="uid"  value="<?php echo $obj->get('uid')?>"/><br>
 厂商ID：<input  class='form-control' type="text"   name="venderID"   value="<?php echo $obj->get('venderID')?>"/><br>
 名字：<input  class='form-control' type="text"   name="name" value="<?php echo $obj->get('name')?>" /><br>
 <img src="<?php echo $obj->get('pic')->get('url');?>" alt="" /><br/>
 图片：<input class='form-control' type="file"   name="pic"  /><br>
 需要积分：<input class='form-control' type="text"   name="integral_need"  value="<?php echo $obj->get('integral_need')?>"/><br>
 价格：<input class='form-control' type="text"   name="price" value="<?php echo $obj->get('price')?>" /><br>
 有效期：<input class='form-control' type="text" name="expiredTime" id="time" placeholder="选择时间" onClick="return Calendar('time');" value="<?php echo tool::arrtime($obj->get('expiredTime'));?>"/> <br>
 链接：<input class='form-control' type="text"  name="url"  value="<?php echo $obj->get('url')?>"/><br>
 可兑状态：<br/>
可兑：<input  type="radio" name="status" value="1" <?php  if($obj->get('status'))echo "checked=\"checked\""; ?> />  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;不可兑：<input type="radio" name="status" value="0" <?php if(!$obj->get('status')) echo "checked=\"checked\""; ?> /><br>
<input class='form-control' type="submit" value="修改" >
</form>
</p>