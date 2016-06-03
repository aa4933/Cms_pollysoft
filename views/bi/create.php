<?php
/* @var $this yii\web\View */

?>
<script type="text/javascript" src="js/showdate.js"></script>
<a class="btn btn-default" href="index.php?r=bi/index">返回</a>
<p>
<h1>增加商家</h1>
<form action="index.php?r=bi/create&create=true" method="post" enctype="multipart/form-data">
 ID：<input class="form-control" type="text" name="uid"/><br/>
 名字：<input class="form-control" type="text"   name="name"  /><br>
 识别代码：<input class="form-control" type="text"   name="orgCode"  /><br>
 详细介绍：<input  class="form-control" type="text"   name="desc"  /><br>
 成立时间：<input class="form-control" type="text" name="setupTime" id="time" placeholder="选择时间" onClick="return Calendar('time');"/> <br>
 展示图(多选)：<input type="file"   name="exhibitPics[]" multiple="multiple" /><br>
 LOGO：<input class="form-control" type="file"   name="logo"  /><br>
 厂商介绍链接：<input class="form-control" type="text"   name="url"  /><br>
 联系电话：<input class="form-control" type="text"   name="telephone"  /><br>
 传真：<input class="form-control" type="text"   name="fax"  /><br>
 固定电话：<input class="form-control" type="text"   name="landlineTel"  value=""/><br>
 联系地址：<input class="form-control" type="text"  name="address"  /><br>

<input class="form-control" type="submit" value="增加商家" >
</form>
</p>