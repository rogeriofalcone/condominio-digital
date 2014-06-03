<?php

namespace Condominio\Repository;

use Gigablah\Silex\OAuth\Security\Authentication\Token\OAuthTokenInterface;

/**
 * OAuth user provider interface.
 *
 * @author Chris Heng <bigblah@gmail.com>
 */
interface OAuthUserProviderInterface
{
    /**
     * Loads a user based on OAuth credentials.
     *
     * @param OAuthTokenInterface $token
     *
     * @return UserInterface|null
     */
    public function loadUserByOAuthCredentials(OAuthTokenInterface $token);
}
