<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */

namespace Infuse\Auth\Models;

use Infuse\Utility as U;
use Pulsar\Model;

class UserLink extends Model
{
    const FORGOT_PASSWORD = 'reset_password';
    const VERIFY_EMAIL = 'verify_email';
    const TEMPORARY = 'temporary';

    protected static $ids = ['user_id', 'link'];

    protected static $properties = [
        'user_id' => [
            'type' => Model::TYPE_NUMBER,
            'required' => true,
        ],
        'link' => [
            'required' => true,
            'validate' => 'string:32',
        ],
        'type' => [
            'validate' => 'enum:reset_password,verify_email,temporary',
            'required' => true,
        ],
    ];

    protected static $autoTimestamps;

    /**
     * @staticvar int
     */
    public static $verifyTimeWindow = 86400; // one day in seconds

    /**
     * @staticvar int
     */
    public static $forgotLinkTimeframe = 1800; // 30 minutes in seconds

    protected function initialize()
    {
        parent::initialize();

        self::creating(['Infuse\Auth\Models\UserLink', 'generateLink']);
    }

    public static function generateLink($event)
    {
        $model = $event->getModel();
        if (!$model->link) {
            $model->link = strtolower(U::guid(false));
        }
    }

    /**
     * Gets the URL for this link.
     *
     * @return string|false
     */
    public function url()
    {
        if ($this->type === self::FORGOT_PASSWORD) {
            return $this->getApp()['base_url'].'users/forgot/'.$this->link;
        }

        return false;
    }
}
