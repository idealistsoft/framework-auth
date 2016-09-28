<?php

use Infuse\Auth\Services\Auth as AuthService;
use Infuse\Test;

class AuthServiceTest extends PHPUnit_Framework_TestCase
{
    public static $ogUser;

    public static function setUpBeforeClass()
    {
        self::$ogUser = Test::$app['user'];
    }

    public static function tearDownAfterClass()
    {
        Test::$app['user'] = self::$ogUser;
    }

    public function testService()
    {
        Test::$app['config']->set('auth.strategies', [
            'test' => 'TestStrategy',
        ]);

        $service = new AuthService(Test::$app);
        $auth = $service(Test::$app);

        $this->assertInstanceOf('Infuse\Auth\Libs\Auth', $auth);
    }
}
