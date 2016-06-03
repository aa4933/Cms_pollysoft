<?php
/* @var $this yii\web\View */
$scaleToFit = false;//true保持原比例，false保持尺寸
$mode = $scaleToFit ? 2 : 1;
$width = 180;//宽度
$height = 100;//高度
$quality = 100;//图片质量
$format = "png";//图片格式
$img="?imageView/$mode/w/$width/h/$height/q/$quality/format/$format"
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">产品列表</div>
    <a class="btn btn-default" role="button" href="index.php?r=pi/create">新增</a>
  <div class="panel-body">
    <p>产品信息(可兑)</p>
  </div>

  <!-- Table -->
  <table class="table">
    <tr>
        <th>产品名字</th>
        <th>图片</th>
        <th>录入时间</th>
        <th>有效期至</th>
        <th>关联能量站数量</th>
    </tr>

   <?php 
        for ($i=0;$i<count($exchange);$i++){
            echo "<tr><td>".$exchange[$i]['name']."</td>";
            //echo "图片:".$delete[$i]['pic']."<br>";
            echo "<td><img class='img-thumbnail' src=".$exchange[$i]['pic']->get('url').$img." alt=\"\" /></td>";
            echo "<td>".$exchange[$i]['createAt']."</td>";
            echo "<td>".$exchange[$i]['expiredTime']."</td>";
            echo "<td>".$exchange[$i]['number']."</td></tr>";
   ?>
   <td><a class="btn btn-default" role="button"href="index.php?r=pi/alter&objectId=<?php echo $exchange[$i]['objectId'];?>">修改</a></td>
   <?php
        } 
   ?>
   </table>
  <div class="panel-body">
    <p>产品信息(不可兑)</p>
  </div>
   <table class="table">
    <tr>
        <th>产品名字</th>
        <th>图片</th>
        <th>录入时间</th>
        <th>有效期至</th>
        <th>关联能量站数量</th>
    </tr>
   <?php 
        for ($i=0;$i<count($arr);$i++){
            echo "<tr><td>".$arr[$i]['name']."</td>";
            //echo "图片:".$arr[$i]['pic']."<br>";
            echo "<td><img class='img-thumbnail' src=".$arr[$i]['pic']->get('url').$img." alt=\"\" /></td>"; 
            echo "<td>".$arr[$i]['createAt']."</td>";
            echo "<td>".$arr[$i]['expiredTime']."</td>";
            echo "<td>".$arr[$i]['number']."</td></tr>";
   ?>
   <td><a class="btn btn-default" role="button" href="index.php?r=pi/alter&objectId=<?php echo $arr[$i]['objectId'];?>">修改</a></td> 
   <?php
        } 
   ?>
   </table>
</div>