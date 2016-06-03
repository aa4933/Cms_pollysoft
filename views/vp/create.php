<?php
/* @var $this yii\web\View */

?>
<script type="text/javascript" src="js/showdate.js"></script>
<a class='btn btn-default' href="index.php?r=vp/index">返回</a>

<h1>商品添加</h1>
<form action="index.php?r=vp/create&create=true" method="post" enctype="multipart/form-data">
 产品ID：<input class='form-control' type="text"   name="uid"  /><br>
 厂商ID：<input class='form-control' type="text"   name="venderID"  /><br>
 名字：<input class='form-control' type="text"   name="name"  /><br>
 图片：<input class='form-control' type="file"   name="pic"  /><br>
 需要积分：<input class='form-control' type="text"   name="integral_need"  /><br>
 价格：<input class='form-control' type="text"   name="price"  /><br>
 有效期：<input class='form-control' type="text" name="expiredTime" id="time" placeholder="选择时间" onClick="return Calendar('time');"/> <br>
 链接：<input class='form-control' type="text"  name="url"  /><br>
 可兑状态：<br/>
 可兑：<input type="radio" name="status" value="1" checked="checked" />  不可兑：<input type="radio" name="status" value="0" /><br>

<input class='btn btn-default' type="submit" value="增加新产品" >
</form>