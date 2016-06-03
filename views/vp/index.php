<?php
use app\models\tool;

function fn(){
 list($a,$b) = explode(' ',microtime()); //获取并分割当前时间戳和微妙数，赋值给变量
 return $a+$b;
}
$start_time = fn();

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
  <div class="panel-heading">未过期<?php echo $a=count($arr1);?>个   已过期<?php echo $b=count($arr2);?>个   </div>
  <a class='btn btn-default' href="index.php?r=vp/create">添加</a>
  

  <!-- Table -->
  <table class="table">

	<tr >
		<th rowspan="<?php echo $a+$b+3;?>" >虚拟<br/>产品<br/>列表</th><th colspan="6">虚拟产品列表（未过期）</th>
	</tr>
  <tr>
    <th>名称</th>
    <th>图片</th>
    <th>有效性</th>
    <th>过期时间</th>
    <th>录入时间</th>
    <th>查看</th>
  </tr>

<?php 
        

        foreach ($arr1 as $key => $arr){
        				echo '<tr>';
        	            echo "<td><a href=\"index.php?r=vp/view&objectId=".$arr->get('objectId')."\">".$arr->get('name')."</a></td>";
        	            echo "<td><img src=".$arr->get('pic')->get('url').$img." alt=\"\" /></td>";
        	            echo "<td>  有效  </td>";
        	            echo "<td>".tool::arrtime($arr->get('expiredTime'))."</td>";
        	            echo "<td>".tool::arrtime($arr->get('createAt'))."</td>";
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=vp/view&objectId=".$arr->get('objectId')."\">详细详细</a></td>";

        	            /* echo "<td><a href=\"index.php?r=vp/modify&objectId=".$arr->get('objectId')."\"><button>修改</button></a></td>";
        	            echo "<td><a href='#'>删除</a></td>"; */
        	            echo '</tr>';
        }
        
            
?>

	<tr>
		<th colspan="6">虚拟产品列表（已过期）</th>
	</tr>
<?php 
        
        
        foreach ($arr2 as $key => $arr){
        	            echo '<tr>';
        	            echo "<td><a href=\"index.php?r=vp/view&objectId=".$arr->get('objectId')."\">".$arr->get('name')."</a></td>";
        	            echo "<td><img src=".$arr->get('pic')->get('url').$img." alt=\"\" /></td>";
        	            echo "<td>  无效  </td>";
        	            echo "<td>".tool::arrtime($arr->get('expiredTime'))."</td>";
        	            echo "<td>".tool::arrtime($arr->get('createAt'))."</td>";
        	            echo "<td><a class='btn btn-default' href=\"index.php?r=vp/view&objectId=".$arr->get('objectId')."\">详细详细</a></td>";

        	            /* echo "<td><a href=\"index.php?r=vp/modify&objectId=".$arr->get('objectId')."\"><button>修改</button></a></td>";
        	            echo "<td><a href='#'>删除</a></td>"; */
        	            echo '</tr>';
        }
        

        
?>

</table>

</div>


