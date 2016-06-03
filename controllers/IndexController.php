<?php

namespace app\controllers;
class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {
            $data=array();
            $data['vp']='虚拟产品';
            $data['bi']='商家信息';
            $data['esi']='能量站信息';
            $data['pi']='产品信息';
        return $this->renderPartial('index',$data);
    }

}
