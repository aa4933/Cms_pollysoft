<?php
use app\models\tool;
/* @var $this yii\web\View */
$scaleToFit = false;//true保持原比例，false保持尺寸

$mode = $scaleToFit ? 2 : 1;

$width = 180;//宽度

$height = 100;//高度

$quality = 100;//图片质量

$format = "png";//图片格式

$img="?imageView/$mode/w/$width/h/$height/q/$quality/format/$format"
?>

<h2>未删除<?php echo $a=count($arr1);?>个   已删除<?php echo $b=count($arr2);?>个   </h2>  <a class='btn btn-default' href="http://localhost/management/web/index.php?r=bi/create">添加</a>
<center><table class="table" >

	<tr >
		<th rowspan="<?php echo $a+$b+3;?>" >商家<br/>列表</th>
		<th colspan="5">商家列表（未删除）</th>
	</tr>
  <tr>
    <th>名字</th>
<!--     <th>识别码</th> -->
<!--     <th>介绍</th> -->
<!--     <th>URL</th> -->
<!--     <th>联系电话</th> -->
<!--     <th>传真</th> -->
<!--     <th>固定电话</th> -->
<!--     <th>联系地址</th> -->
    <th>LOGO</th>
    <th>录入时间</th>
    <th>修改</th>
    <th>删除</th>
  </tr>

<?php 
        

        foreach ($arr1 as $key => $arr){
        				echo '<tr>';
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=bi/view&objectId=".$arr->get('objectId')."\">".$arr->get('name')."</a></td>";
        	            /* echo "<td>".$arr->get('orgCode')."</td>";
        	            echo "<td>".$arr->get('desc')."</td>";
        	            echo "<td>".$arr->get('url')."</td>";
        	            echo "<td>".$arr->get('telephone')."</td>";
        	            echo "<td>".$arr->get('fax')."</td>";
        	            echo "<td>".$arr->get('landlineTel')."</td>";
        	            echo "<td>".$arr->get('address')."</td>"; */
        	            echo "<td><img class='img-thumbnail' src=".$arr->get('logo')->get('url').$img." alt=\"\" /></td>";
        	            echo "<td>".tool::arrtime($arr->get('createAt'))."</td>";
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=bi/modify&objectId=".$arr->get('objectId')."\">修改</a></td>";
        	            echo "<td><a  href=\"index.php?r=bi/delete&objectId=".$arr->get('objectId')."\"><button class='btn btn-default' onclick=\"return confirm('确定要删除?')\">删除</button></td>";
        	            echo '</tr>';
        }
        
            
?>

	<tr>
		<th colspan="5">商家列表（已删除）</th>
	</tr>
<?php 
        
        
        foreach ($arr2 as $key => $arr){
        	            echo '<tr>';
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=bi/view&objectId=".$arr->get('objectId')."\">".$arr->get('name')."</a></td>";
        	            /* echo "<td>".$arr->get('orgCode')."</td>";
        	            echo "<td>".$arr->get('desc')."</td>";
        	            echo "<td>".$arr->get('url')."</td>";
        	            echo "<td>".$arr->get('telephone')."</td>";
        	            echo "<td>".$arr->get('fax')."</td>";
        	            echo "<td>".$arr->get('landlineTel')."</td>";
        	            echo "<td>".$arr->get('address')."</td>"; */
        	            echo "<td><img class='img-thumbnail' src=".$arr->get('logo')->get('url').$img." alt=\"\" /></td>";
        	            echo "<td>".tool::arrtime($arr->get('createAt'))."</td>";
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=bi/modify&objectId=".$arr->get('objectId')."\"><button>修改</button></a></td>";
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=bi/delete&objectId=".$arr->get('objectId')."\"><button onclick=\"return confirm('确定要删除?')\">删除</button></td>";
        	            echo '</tr>';
        }
        
            
?>

</table></center>

