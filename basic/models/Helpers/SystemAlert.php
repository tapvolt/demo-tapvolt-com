<?php

namespace app\models\helpers;

use yii\bootstrap\Alert;

class SystemAlert extends \yii\bootstrap\Alert
{

    public static function show()
    {
        foreach (\Yii::$app->session->getAllFlashes() as $key => $message) {

            echo Alert::widget([
                'options' => [
                    'class' => sprintf('alert-%s', $key),
                ],
                'body' => '<i class="fa fa-exclamation-triangle"></i> ' . $message,
            ]);

        };
    }
}
