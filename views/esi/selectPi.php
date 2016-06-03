<?php
/* @var $this yii\web\View */
    if (isset($arr)) {
        
?>
<a class="btn btn-default"  href="index.php?r=esi/index">返回</a>
<p>
<h1>能量站选择列表(状态为不可兑换)</h1>
<?php 
    foreach ($arr as $key=>$value){
        echo "名字:".$value['name']."<br>";
        echo "uid:".$value['productID']."<br>";
?>
       <h2> 将状态修改为:</h2>
                <form action='index.php?r=esi/addrelation&objectId=".$objectId."&alter=true&provider=".$provider."&product=".$value['productID']."' method='post'>
                        <select name='state'>
                                    <option value='1'>不可兑换</option>
                                    <option value='2'>可兑换</option>
                        </select>
                <input class="btn btn-default"  type='submit' value='保存'  onclick="javascript:alert('提交成功')">
                </form>     
<?php 
    }
?>
</p>
<?php 
    }else {
        echo '<a class="btn btn-default"  href="index.php?r=esi/index">返回</a>';
        echo '<h1>没有对应的数据<h1>';
    }
?>