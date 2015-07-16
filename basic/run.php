<?php
/**
 * http://stackoverflow.com/questions/18606807/debugging-codeception-tests-with-xdebug
 * Codeception PHP script runner
 */


require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

require_once dirname(__FILE__) . '/../vendor/codeception/codeception/autoload.php';

$app = new yii\web\Application($config);
$app->add(new Codeception\Command\Run('run'));

$app->run();
