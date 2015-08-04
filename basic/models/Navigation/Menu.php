<?php

namespace app\models\Navigation;

use yii\bootstrap\NavBar;
use kartik\nav\NavX;

class Menu extends NavBar {

    private $globalHome;
    private $menuItems = [];

    public function __construct()
    {
        $this->globalHome = new GlobalHome();
    }

    public function getGlobalHome()
    {
        return $this->globalHome->home();
    }

    public function mainMenu()
    {
        $this->setMenus();
        $this->echoMenus();
    }

    public function setMenus()
    {
        if (\Yii::$app->user->isGuest) {
            array_push($this->menuItems, ['label' => 'Sign In', 'url' => ['/site/login']]);
        } else {
            array_push($this->menuItems, ['label' => 'Admin', 'items' => [
                ['label' => 'User', 'url' => ['/user/']],
                ['label' => 'Client', 'url' => ['/client/']],
                ['label' => 'Project', 'url' => ['/project/']]
            ]]);
            array_push($this->menuItems, ['label' => 'System', 'items' => [
                ['label' => 'User', 'url' => ['/user/']],
                ['label' => 'Client', 'url' => ['/client/']],
                ['label' => 'Project', 'url' => ['/project/']]
            ]]);
            array_push($this->menuItems, ['label' => 'Logout (' . \Yii::$app->user->identity->name . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]);

        }
    }

    public function echoMenus()
    {
        NavBar::begin($this->getGlobalHome());

        echo NavX::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $this->getMenus(),
            'activateParents' => true,
            'encodeLabels' => false
        ]);

        NavBar::end();
    }

    public function getMenus()
    {
        return $this->menuItems;
    }




///        echo NavX::widget([
////            'options' => ['class' => 'navbar-nav navbar-right'],
////            'items' => [
////                ['label' => 'Action', 'url' => '#'],
////                ['label' => 'Subm&enu 1', 'active'=>true, 'items' => [
////                    ['label' => 'Action', 'url' => '#'],
////                    ['label' => 'Another action', 'url' => '#'],
////                    ['label' => 'Something else here', 'url' => '#'],
////                    '<li class="divider"></li>',
////                    ['label' => 'Submenu 2', 'items' => [
////                        ['label' => 'Action', 'url' => '#'],
////                        ['label' => 'Another action', 'url' => '#'],
////                        ['label' => 'Something else here', 'url' => '#'],
////                        '<li class="divider"></li>',
////                        ['label' => 'Separated link', 'url' => '#'],
////                    ]],
////                ]],
////                ['label' => 'Something else here', 'url' => '#'],
////                '<li class="divider"></li>',
////                ['label' => 'Separated link', 'url' => '#'],
////            ],
////            'activateParents' => true,
////            'encodeLabels' => false
////        ]);


}
