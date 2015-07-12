<?php

namespace tests\codeception\unit\models;

use yii\codeception\TestCase;
use app\models\helpers\Password;

class PasswordTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function passwordLengthProvider()
    {
        return [
            [mt_rand(3, 16)],
            [mt_rand(3, 16)],
            [mt_rand(3, 16)],
        ];
    }

    public function passwordsToHashProvider()
    {
        return [
            ['password'],
            ['UIhiuhsyIY897!@$'],
            [287348923402389],
            [null],
            [false],
        ];
    }

    /**
     * @param int $length
     * @dataProvider passwordLengthProvider
     */
    public function testGeneratePasswordLengthIsHonoured($length)
    {
        $password = Password::generate($length);
        $this->assertEquals($length, strlen($password));
    }

    /**
     * @param string $password
     * @dataProvider passwordsToHashProvider
     */
    public function testGenerateHashReturnsAString($password)
    {
        $hash = Password::hash($password);
        $this->assertEquals(true, is_string($hash));
    }
}
