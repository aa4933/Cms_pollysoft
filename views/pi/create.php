<?php
/* @var $this yii\web\View */

?>
<a  class="btn btn-default" href="index.php?r=pi/index">返回</a>

<h1>产品新增</h1>
<form action="index.php?r=pi/create&create=true" method="post" enctype="multipart/form-data">
 ID：<input type="text"  placeholder="这里输入标识的UID"  name="uid"  /><br><br>
 厂商ID：<input type="text"  placeholder="这里输入对应厂商的ID"  name="venderID"  /><br><br>
 名字：<input type="text"  placeholder="这里输入产品名字"  name="name"  /><br><br>
 图片：<input  class="btn btn-default" type="file"  placeholder="这里输入 产品图片"  name="pic"  /><br><br>
 需要的积分：<input type="text"  placeholder="这里输入 需要的积分"  name="integral_need"  /><br><br>
 价格：<input type="text"  placeholder="这里输入 价格"  name="price"  /><br><br>
 (单位：天)有效期：<input type="text"  placeholder="这里输入有效期"  name="expiredTime"  /><br> <br> 
产品信息链接：<input type="text"  placeholder="这里输入产品信息链接"  name="url"  /><br>  <br>
可兑状态：<input type="text"  placeholder="这里输入可兑状态"  name="status"  /><br>  <br>
<input  class="btn btn-default" type="submit" value="增加新记录" >
</form>
   