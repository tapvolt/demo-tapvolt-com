<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Status;

class StatusController extends Controller
{
    public function actionCreate()
    {
        $status = new Status();

        if ($status->load(Yii::$app->request->post()) && $status->validate()) {
            return $this->render('view', ['status' => $status]);
        } else {
            return $this->render('create', ['status' => $status]);
        }

    }

}
