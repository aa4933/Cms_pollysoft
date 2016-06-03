<?php
use app\models\tool;
/* @var $this yii\web\View */

?>
<script type="text/javascript" src="js/showdate.js"></script>
<a href="index.php?r=pi/index" class="btn btn-default" role="button">返回</a>

<a class="btn btn-default" role="button" href="index.php?r=pi/relation&objectId=<?php echo $obj->get('objectId') ?>">关联的能量站信息</a>
<form class="form-horizontal" action="index.php?r=pi/alter&alter=true&objectId=<?php echo $obj->get('objectId') ?>" method="post">
<div class="form-group form-group-sm">
<label class="col-sm-2 control-label" for="formGroupInputLarge">产品资料修改</label><br>
uid：<br><input class="form-control" type="text"  placeholder="这里输入uid"  name="uid" value="<?php echo $obj->get('uid')?>" />
厂商ID：<input class="form-control" type="text"  placeholder="这里输入厂商ID"  name="venderID" value="<?php echo $obj->get('venderID')?>" />
 名字：<input class="form-control" type="text"  placeholder="这里输入名字"  name="name" value="<?php echo $obj->get('name')?>" /><br>
 图片：<img class="img-thumbnail" src="<?php echo $obj->get('pic')->get('url');?>" alt="" />
 <input class="form-control" type="file"   name="pic"  /><br>
 需要的积分：<input class="form-control" type="text"  placeholder="这里输入需要的积分"  name="integral_need" value="<?php echo $obj->get('integral_need')?>" /><br>
 价格：<input class="form-control" type="text"  placeholder="这里输入 价格"  name="price" value="<?php echo $obj->get('price')?>" /><br>
 有效期：<input class="form-control" type="text" name="expiredTime" id="time" placeholder="选择时间" onClick="return Calendar('time');" value="<?php echo tool::arrtime($obj->get('expiredTime'));?>"/><br> 
产品信息链接：<input class="form-control" type="text"  placeholder="这里输入产品信息链接"  name="url" value="<?php echo $obj->get('url')?>" /><br>
删除标记（1代表未被删除，0代表已经删除）：<input class="form-control" type="text"  placeholder="这里输入删除标记"  name="isDeleted" value="<?php echo $obj->get('isDeleted')?>" /><br>
可兑换状态（只能1或0）：<input class="form-control" type="text"  placeholder="这里输入可兑换状态"  name="status" value="<?php echo $obj->get('status')?>" /><br>
<br><input class="form-control" type="submit" value="保存" >
</div>
</form>
   

