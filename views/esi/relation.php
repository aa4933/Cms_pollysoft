<?php
/* @var $this yii\web\View */
?>
<h1>能量站关联产品界面</h1>
<a class="btn btn-default"  href="index.php?r=esi/index">返回</a>
<p>
<h1>能量站信息(简要)</h1>
   <?php 
            echo "能量站名字:".$arr['name']."<br>";
            //echo "图片:".$delete[$i]['address']."<br>";
            echo "录入时间:".$arr['createAt']."<br>";
            echo "地址:".$arr['address']."<br>";
   ?>
   <br>
   <h1>可兑换产品【未过期】：</h1> 
            <?php 
              foreach ($uninvalid as $key=>$value){
                  echo "当前状态为:".$value['available']."<br>";
                  echo "产品名字:".$value['productID']."<br>"."
       <h2> 将状态修改为:</h2>
                <form action='index.php?r=esi/relation&productID=".$value['productID']."&keep=true&objectId=".$objectId."' method='post'>
                        <select name='state'>
                                    <option value='1'>不可兑换</option>
                                    <option value='2'>可兑换</option>
                        </select>
                <input type='submit' value='保存' >
                </form>         
         ";
                }
            ?>  
<h1>可兑换产品【已过期】：</h1>   
            <?php 
              foreach ($invalid as $key=>$value){
                  echo "当前状态为:".$value['available']."<br>";
                  echo "产品名字:".$value['productID']."<br>";
                }
            ?>  
 <a class="btn btn-default"  href="index.php?r=esi/addrelation&objectId=<?php echo $objectId; ?>">新增</a>
</p>