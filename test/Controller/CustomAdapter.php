<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-oauth2 for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ApiTools\OAuth2\Controller;

use Laminas\ApiTools\ApiProblem\Exception\DomainException;
use OAuth2\Storage\Memory;

class CustomAdapter extends Memory
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function checkUserCredentials($username, $password)
    {
        // mocking logic to throw an exception if the user is banned
        if ($username === 'banned_user') {
            $loginException = new DomainException('User is banned', 401);
            $loginException->setTitle('banned');
            $loginException->setType('http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html');
            throw $loginException;
        }

        return parent::checkUserCredentials($username, $password);
    }

    /**
     * @param string $clientId
     * @return bool
     */
    public function isPublicClient($clientId)
    {
        return true;
    }
}
