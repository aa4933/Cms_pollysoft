<?php

namespace app\controllers;
use LeanCloud\LeanClient;
use LeanCloud\LeanQuery;
use LeanCloud\LeanUser;
use LeanCloud\LeanObject;
use LeanCloud\CloudException;
class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // ��������Ϊ app-id, app-key, master-key
        $result=LeanClient::initialize("6IhXN3Udda8oLQfSrA9k8QY2-gzGzoHsz", "VC61N0QhMt6bD8KPBLPqyfUJ", "9YS8jNkuQW651f3JG2OECyD4
        ");

        
        
        $obj2 = new LeanObject("TestObject2");
        /* 
        $obj->set("height", 60.0);
        $obj->set("weight", 4.5);
        $obj->set("birthdate", new \DateTime());
        try {
              $result2=$obj->save();
              var_dump($result2);
            } catch (CloudException $ex) {
               // CloudException 会被抛出，如果保存失败
            }
         */
        $query = new LeanQuery("TestObject2");
        $query->equalTo('name','alice1111');
        $obj=$query->find();
        var_dump($obj);
      var_dump($obj2->getClassName());
        
        //$result3=$obj->destroy();
    }

}
