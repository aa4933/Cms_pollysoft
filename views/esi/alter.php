<?php
/* @var $this yii\web\View */

?>
<a class="btn btn-default" href="index.php?r=esi/index">返回</a>
<p>
<h1>能量站修改</h1>
<a class="btn btn-default" href="index.php?r=esi/relation&objectId=<?php echo $obj->get('objectId') ?>">关联的产品信息</a><br>
<form action="index.php?r=esi/alter&alter=true&objectId=<?php echo $obj->get('objectId') ?>" method="post">
 能量站名字：<input class="form-control" type="text"  placeholder="这里输入能量站名字"  name="name" value="<?php echo $obj->get('name')?>" /><br>
城市代码：      <select class="form-control" name="cityCode">
        <option value="<?php echo $obj->get('cityCode')?>"><?php echo $obj->get('cityCode')?></option>
        <option value="1">厦门</option>
        <option value="2">福州</option>
        <option value="3">泉州</option>
        </select><br>
 介绍链接：<input class="form-control" type="text"  placeholder="这里输入介绍链接"  name="url" value="<?php echo $obj->get('url')?>" /><br>
 联系电话：<input class="form-control" type="text"  placeholder="这里输入 联系电话"  name="telephone" value="<?php echo $obj->get('telephone')?>" /><br>
 传真：<input class="form-control" type="text"  placeholder="这里输入 传真"  name="fax" value="<?php echo $obj->get('fax')?>" /><br>
 固定电话：<input class="form-control" type="text"  placeholder="这里输入 固定电话"  name="landlineTel" value="<?php echo $obj->get('landlineTel')?>" /><br>
 联系地址：<input class="form-control" type="text"  placeholder="这里输入联系地址"  name="address" value="<?php echo $obj->get('address')?>" /><br>
识别代码：<input class="form-control" type="text"  placeholder="这里输入识别代码"  name="regCode" value="<?php echo $obj->get('regCode')?>" /><br>
uid：<input class="form-control" type="text"  placeholder="这里输入UID"  name="uid" value="<?php echo $obj->get('uid')?>" /><br> 
<input class="btn btn-default" type="submit" value="保存" >
</form>
</p>