<?php

namespace app\models\Navigation;

class MenuManager {

    public static function getMenu()
    {
        return new Menu();
    }
}
