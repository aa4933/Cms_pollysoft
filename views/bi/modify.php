<?php
use app\models\tool;
/* @var $this yii\web\View */

?>
<script type="text/javascript" src="js/showdate.js"></script>
<a class="btn btn-default" href="index.php?r=bi/index">返回</a>
<p>
<h1>修改商家</h1>
<form action="index.php?r=bi/modify&modify=true&objectId=<?php echo $obj->get('objectId') ?>"  method="post" enctype="multipart/form-data">

<table class='table'>
  <tr>
    <td>ID：</td><td><input type="text"   name="uid"   value="<?php echo $obj->get('uid');?>"/></td>
  </tr>
   <tr>
    <td>名字：</td><td><input type="text"   name="name"   value="<?php echo $obj->get('name')?>"/></td>
  </tr>
<tr>
    <td>识别代码：</td><td><input type="text"   name="orgCode"   value="<?php echo $obj->get('orgCode')?>"/></td>
  </tr>
  <tr>
    <td>详细介绍：</td><td><input type="text"   name="desc"   value="<?php echo $obj->get('desc')?>"/></td>
  </tr>
  <tr>
    <td>成立时间：</td><td><input type="text" name="setupTime" id="time" value="<?php echo tool::arrtime($obj->get('setupTime'));?>" placeholder="选择时间" onClick="return Calendar('time');"/></td>
  </tr>
  <tr>
 <td>展示图(多选)：</td><td><input type="file"   name="exhibitPics[]" multiple="multiple" /></td>
     <?php //echo $obj->get('exhibitPics');
        foreach ($obj->get('exhibitPics') as $key=> $value) {
            echo "<td><img src=".$value." alt=\"\" /></td>";
        }
    ?>
    </tr>
  <tr>
    <td>LOGO：</td><td><input type="file"   name="logo"  /></td><td><img class='img-thumbnail' src="<?php echo $obj->get('logo')->get('url');?>" alt="" /  ></td>
  </tr>
  <tr>
    <td> 链接：</td><td><input type="text"   name="url"   value="<?php echo $obj->get('url')?>"/></td>
  </tr>
  <tr>
    <td>联系电话：</td><td><input type="text"   name="telephone"   value="<?php echo $obj->get('telephone')?>"/></td>
  </tr>
  <tr>
    <td>传真：</td><td><input type="text"   name="fax"   value="<?php echo $obj->get('fax')?>"/></td>
  </tr>
  <tr>
    <td>固定电话：</td><td><input type="text"   name="landlineTel"   value="<?php echo $obj->get('landlineTel')?>"/></td>
  </tr>
  <tr>
    <td>联系地址：</td><td><input type="text"   name="address"   value="<?php echo $obj->get('address')?>"/></td>
  </tr>

  <tr>
    <td>删除标记：</td><td>未删除：<input type="radio" name="isDeleted" value="1" <?php  if(!$obj->get('isDeleted'))echo "checked=\"checked\""; ?> />  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;已删除：<input type="radio" name="isDeleted" value="0" <?php if($obj->get('isDeleted')) echo "checked=\"checked\""; ?> /></td>
  </tr>



   </table>

<input class="btn btn-default"  type="submit" value="提交修改" >
</form>
  
</p>