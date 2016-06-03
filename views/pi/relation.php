<?php
/* @var $this yii\web\View */
?>
<h1>产品关联能量站界面</h1>
<a  class="btn btn-default" href="index.php?r=pi/index">返回</a>
<p>
<h2>产品信息(简要)</h2>
   <?php 
            echo "<small>产品名字:</small>".$arr['name']."<br>";
            //echo "图片:".$delete[$i]['address']."<br>";
            echo "<small>录入时间:</small>".$arr['createAt']."<br>";
            echo "<small>有效期至:</small>".$arr['expiredTime']."<br>";
   ?>
   <br>
<h2>可兑换能量站【可兑】：</h2> 
            <?php 
              foreach ($arrayNotdeleted as $key=>$value){
                  echo "当前状态为:".$value['available']."<br>";
                  echo "能量站名字:".$value['providerID']."<br>"."
       <h2> 将状态修改为:</h2>
                <form action='index.php?r=pi/relation&providerID=".$value['providerID']."&keep=true&objectId=".$objectId."' method='post'>
                        <select name='state'>
                                    <option value='1'>不可兑换</option>
                                    <option value='2'>可兑换</option>
                        </select>
                <input class='btn btn-default' type='submit' value='保存' >
                </form>         
         ";
                }
            ?>  
<h2>可兑换能量站【已删除】：</h2>   
            <?php 
              foreach ($arrayDeleted as $key=>$value){
                  echo "当前状态为:".$value['available']."<br>";
                  echo "能量站名字:".$value['providerID']."<br>";
                }
            ?>  
 <a  class="btn btn-default" href="index.php?r=pi/addrelation&objectId=<?php echo $objectId; ?>">新增</a>
 
</p>
