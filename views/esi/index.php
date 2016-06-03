<?php
/* @var $this yii\web\View */
?>
<h1>能量站列表</h1>
<a class="btn btn-default" href="index.php?r=esi/create">新增</a>
<h2>能量站信息(已经删除)</h2>
<table class="table table-striped">
<tr>
    <th>名字</th>
    <th>地址</th>
    <th>创建时间</th>
    <th>识别代码</th>
    <th>库存</th>
</tr>
   <?php 
        for ($i=0;$i<count($delete);$i++){
            echo '<tr><td>'.$delete[$i]['name']."</td>";
            echo '<td>'.$delete[$i]['address']."</td>";
            echo '<td>'.$delete[$i]['createAt']."</td>";
            echo '<td>'.$delete[$i]['regCode']."</td>";
            if (isset($delete[$i]['stock'])) {
                echo '<td>'.$delete[$i]['stock']."</td></tr>";
            }else {
                echo "<td>库存:暂无此项记录</td></tr>";
            }
   ?>
   <td><a class="btn btn-default" href="index.php?r=esi/alter&objectId=<?php echo $delete[$i]['objectId'];?>">修改</a></td>
   <?php
        } 
   ?>
   </table>
   <h2>能量站信息(未删除)</h2>
   <table class="table table-striped">
   <tr>
      <th>名字</th>
      <th>地址</th>
      <th>创建时间</th>
      <th>识别代码</th>
      <th>库存</th>
   </tr>
   <?php 
        for ($i=0;$i<count($arr);$i++){
            echo "<tr><td>".$arr[$i]['name']."</td>";
            echo "<td>地址:".$arr[$i]['address']."</td>";
            echo "<td>创建时间:".$arr[$i]['createAt']."</td>";
            echo "<td>识别代码:".$arr[$i]['regCode']."</td>";
            if (isset($delete[$i]['stock'])) {
                echo "<td>库存:".$delete[$i]['stock']."</td></tr>";
            }else {
                echo "<td>库存:暂无此能量站对应记录</td></tr>";
            }
   ?>
   <td><a class="btn btn-default" href="index.php?r=esi/alter&objectId=<?php echo $arr[$i]['objectId'];?>">修改</a>
   <a class="btn btn-default" href="index.php?r=esi/delete&objectId=<?php echo $arr[$i]['objectId'];?>">删除</a></td>
   <?php
        } 
   ?>
    </tr>
    </table>

