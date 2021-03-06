<?php

/**
 * @author Jared King <j@jaredtking.com>
 *
 * @link http://jaredtking.com
 *
 * @copyright 2015 Jared King
 * @license MIT
 */

namespace Infuse\Auth\Interfaces;

use Infuse\Request;
use Infuse\Response;

interface StorageInterface
{
    /**
     * Starts a new user session.
     *
     * @param UserInterface $user
     * @param Request       $req
     * @param Response      $res
     *
     * @return bool
     */
    public function signIn(UserInterface $user, Request $req, Response $res);

    /**
     * Saves a remember me token on the user's session.
     *
     * @param UserInterface $user
     * @param Request       $req
     * @param Response      $res
     *
     * @return bool
     */
    public function remember(UserInterface $user, Request $req, Response $res);

    /**
     * Marks a user as two-factor verified for the current session.
     *
     * @param UserInterface $user
     * @param Request       $req
     * @param Response      $res
     *
     * @return bool
     */
    public function twoFactorVerified(UserInterface $user, Request $req, Response $res);

    /**
     * Gets the authenticated user for the current session. If the
     * user was previously marked as two-factor verified for the
     * current session then the returned user must have this designation.
     *
     * @param Request  $req
     * @param Response $res
     *
     * @return UserInterface|false
     */
    public function getAuthenticatedUser(Request $req, Response $res);

    /**
     * Signs out the current user session.
     *
     * @param Request  $req
     * @param Response $res
     *
     * @return bool
     */
    public function signOut(Request $req, Response $res);
}
