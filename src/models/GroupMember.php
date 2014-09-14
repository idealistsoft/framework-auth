<?php

/**
 * @package infuse\framework
 * @author Jared King <j@jaredtking.com>
 * @link http://jaredtking.com
 * @version 0.1.16
 * @copyright 2013 Jared King
 * @license MIT
 */

namespace app\auth\models;

use infuse\Model;

use app\auth\libs\Auth;

class GroupMember extends Model
{
    public static $scaffoldApi;
    public static $autoTimestamps;

    public static $properties = [
        'group' => [
            'type' => 'string'
        ],
        'uid' => [
            'type' => 'number',
            'relation' => Auth::USER_MODEL
        ]
    ];

    public static function idProperty()
    {
        return [ 'group', 'uid' ];
    }

    protected function hasPermission($permission, Model $requester)
    {
        return $requester->isAdmin();
    }
}