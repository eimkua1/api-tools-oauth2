<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-oauth2 for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ApiTools\OAuth2\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class OAuth2ServerFactory
{
    /**
     * @return OAuth2ServerInstanceFactory
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = $config['api-tools-oauth2'] ?? [];
        return new OAuth2ServerInstanceFactory($config, $container);
    }

    /**
     * Provided for backwards compatibility; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return OAuth2ServerInstanceFactory
     */
    public function createService($container)
    {
        return $this($container);
    }
}
