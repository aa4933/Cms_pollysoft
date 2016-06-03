<?php
/* @var $this yii\web\View */

?>
<a class="btn btn-default" href="index.php?r=esi/index">返回</a>
<p>
<h1>能量站新增</h1>
<form action="index.php?r=esi/create&create=true" method="post">
 能量站名字：<input class="form-control" type="text"  placeholder="这里输入能量站名字"  name="name"  /><br>
 城市代码：<input class="form-control" type="text"  placeholder="这里输入城市代码"  name="cityCode"  /><br>
 介绍链接：<input class="form-control" type="text"  placeholder="这里输入介绍链接"  name="url"  /><br>
 联系电话：<input class="form-control" type="text"  placeholder="这里输入 联系电话"  name="telephone"  /><br>
 传真：<input class="form-control" type="text"  placeholder="这里输入 传真"  name="fax"  /><br>
 固定电话：<input class="form-control" type="text"  placeholder="这里输入 固定电话"  name="landlineTel"  /><br>
 联系地址：<input class="form-control" type="text"  placeholder="这里输入联系地址"  name="address"  /><br> 
识别代码：<input  class="form-control" type="text"  placeholder="这里输入识别代码"  name="regCode"  /><br> 
uid：<input class="form-control" type="text"  placeholder="这里输入UID"  name="uid"  /><br> 
<input class="form-control" type="submit" value="增加新记录" >
</form>
</p>