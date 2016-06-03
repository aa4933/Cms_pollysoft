<?php
/* @var $this yii\web\View */

?>
<a class="btn btn-default" href="index.php?r=pi/index">返回</a>
<p>
<h1>产品选择列表(状态为不可兑换)</h1>
<?php 
    foreach ($arr as $key=>$value){
        echo "名字:".$value['name']."<br>";
        echo "uid:".$value['uid']."<br>"."
       <h2> 将状态修改为:</h2>
                <form action='index.php?r=pi/addrelation&objectId=".$objectId."&alter=true&product=".$product."&provider=".$value['uid']."' method='post'>
                        <select name='state'>
                                    <option value='1'>不可兑换</option>
                                    <option value='2'>可兑换</option>
                        </select>
                <input class='btn btn-default' type='submit' value='保存' >
                </form>     ";
    }
?>
</p>