<?php
/* @var $this yii\web\View */
?>
<h1>首页</h1>

<p>
    
   <h1>这里是：<a href='<?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=vp/index';?>'><?php echo $vp; ?></a></h1>
   <?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=vp/index';?>
   
    
   <h1>这里是：<a href='<?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=bi/index';?>'><?php echo $bi; ?></a></h1>
   <?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=bi/index';?>
     
     
   <h1>这里是：<a href='<?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=esi/index';?>'><?php echo $esi; ?></a></h1>
   <?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=esi/index';?>
      
      
   <h1>这里是：<a href='<?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=pi/index';?>'><?php echo $pi; ?></a></h1>
   <?php echo Yii::$app->request->hostInfo.'/management/web/index.php?r=pi/index';?>
   
   
   <code>本页面地址：<?= __FILE__; ?></code>.
</p>
