<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */

namespace Infuse\Auth\Jobs;

use Infuse\Auth\Models\PersistentSession;
use Infuse\Auth\Models\UserLink;
use Infuse\HasApp;
use Infuse\Utility as U;

class GarbageCollection
{
    use HasApp;

    public function __invoke($run)
    {
        return $this->run();
    }

    /**
     * Runs the auth garbage collection.
     *
     * @return array
     */
    public function run()
    {
        $res1 = $this->gcPersistent();
        $res2 = $this->gcUserLinks();
        $res3 = $this->gcActive();

        return $res1 && $res2 && $res3;
    }

    /**
     * Clears out expired active sessions.
     *
     * @return bool
     */
    private function gcActive()
    {
        return (bool) $this->app['database']->getDefault()
            ->delete('ActiveSessions')
            ->where('expires', time() - 3600, '<')
            ->execute();
    }

    /**
     * Clears out expired persistent sessions.
     *
     * @return bool
     */
    private function gcPersistent()
    {
        return (bool) $this->app['database']->getDefault()
            ->delete('PersistentSessions')
            ->where('created_at', U::unixToDb(time() - PersistentSession::$sessionLength), '<')
            ->execute();
    }

    /**
     * Clears out expired user links.
     *
     * @return bool
     */
    private function gcUserLinks()
    {
        return (bool) $this->app['database']->getDefault()
            ->delete('UserLinks')
            ->where('type', UserLink::FORGOT_PASSWORD)
            ->where('created_at', U::unixToDb(time() - UserLink::$forgotLinkTimeframe), '<')
            ->execute();
    }
}
