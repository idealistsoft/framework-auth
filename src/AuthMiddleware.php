<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */

namespace Infuse\Auth;

use Infuse\HasApp;
use Pulsar\ACLModelRequester;

class AuthMiddleware
{
    use HasApp;

    public function __invoke($req, $res, $next)
    {
        // inject the request/response into auth
        $auth = $this->app['auth'];
        $auth->setRequest($req)->setResponse($res);

        $user = $auth->getAuthenticatedUser();

        // use the authenticated user as the requester for model permissions
        ACLModelRequester::set($user);
        $this->app['requester'] = $user;

        return $next($req, $res);
    }
}
