<?php
use app\models\tool;
/* @var $this yii\web\View */

?>
<a class="btn btn-default" href="index.php?r=bi/index">返回</a>
<p>
<h1>详细详细</h1>
<table class="table table-striped">
  <tr>
    <td>ID：</td><td><?php echo $obj->get('uid');?></td>
  </tr>
   <tr>
    <td>名字：</td><td><?php echo $obj->get('name');?></td>
  </tr>
<tr>
    <td>识别代码：</td><td><?php echo $obj->get('orgCode');?></td>
  </tr>
  <tr>
    <td>详细介绍：</td><td><?php echo $obj->get('desc');?></td>
  </tr>
  <tr>
    <td>成立时间：</td><td><?php echo tool::arrtime($obj->get('setupTime'));?></td>
  </tr>
  <tr>
 <td>展示图：</td>
     <?php //echo $obj->get('exhibitPics');
        foreach ($obj->get('exhibitPics') as $key=> $value) {
            echo "<td><img src=".$value." alt=\"\" /></td>";
        }
    ?>
    </tr>
  <tr>
    <td>LOGO：</td><td><img src="<?php echo $obj->get('logo')->get('url');?>" alt="" /  ></td>
  </tr>
  <tr>
    <td> 链接：</td><td><?php echo $obj->get('url')?></td>
  </tr>
  <tr>
    <td>联系电话：</td><td><?php echo $obj->get('telephone')?></td>
  </tr>
  <tr>
    <td>传真：</td><td><?php echo $obj->get('fax')?></td>
  </tr>
  <tr>
    <td>固定电话：</td><td><?php echo $obj->get('landlineTel')?></td>
  </tr>
  <tr>
    <td>联系地址：</td><td><?php echo $obj->get('address')?></td>
  </tr>
  <tr>
    <td>录入时间:</td><td><?php echo tool::arrtime($obj->get('createAt'));?></td>
  </tr>
  <tr>
    <td>删除标记：</td><td><?php echo  $obj->get('isDeleted')?"已被删除":"未被删除";?></td>
  </tr>

  <tr>
    <td colspan="2" align="center"><a class="btn btn-default" href="index.php?r=bi/modify&objectId=<?php echo $obj->get('objectId');?>">修改</a></td>
  </tr>


   </table>

</p>