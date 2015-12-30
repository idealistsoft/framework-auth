<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */
use App\Auth\Models\UserLink;

class UserLinkTest extends PHPUnit_Framework_TestCase
{
    public static $link;

    public function testHasPermission()
    {
        $link = new UserLink();

        $this->assertTrue($link->can('create', Test::$app['user']));

        $this->assertFalse($link->can('admins-only', Test::$app['user']));
    }

    public function testCannotCreate()
    {
        $errorStack = Test::$app['errors'];
        $errorStack->clear();
        $errorStack->clearCurrentContext();

        $link = new UserLink();

        $this->assertFalse($link->create([
            'uid' => Test::$app['user']->id() - 1,
            'link_type' => UserLink::FORGOT_PASSWORD, ]));
        $errors = $errorStack->errors();
        $expected = [[
            'error' => 'no_permission',
            'message' => 'no_permission',
            'context' => '',
            'params' => [], ]];
        $this->assertEquals($expected, $errors);
    }

    public function testCreate()
    {
        self::$link = new UserLink();
        self::$link->grantAllPermissions();
        $this->assertTrue(self::$link->create([
            'uid' => -1,
            'link_type' => UserLink::FORGOT_PASSWORD, ]));
    }

    /**
     * @depends testCreate
     */
    public function testDelete()
    {
        $this->assertTrue(self::$link->delete());
    }

    public function testGarbageCollect()
    {
        $this->assertTrue(UserLink::garbageCollect());
    }
}
