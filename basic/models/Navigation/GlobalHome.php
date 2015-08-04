<?php

namespace app\models\Navigation;


class GlobalHome {

    private $brandLabel;
    private $brandUrl;

    public function __construct()
    {
        $this->brandLabel = 'My Company';
        $this->brandUrl = \Yii::$app->homeUrl;
    }

    public function getBrandLabel()
    {
        return $this->brandLabel;
    }

    public function getBrandUrl()
    {
        return $this->brandUrl;
    }

    public function home()
    {
        return [
            'brandLabel' => $this->getBrandLabel(),
            'brandUrl' => $this->getBrandUrl(),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ];
    }
}
