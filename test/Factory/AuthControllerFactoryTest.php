<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-oauth2 for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ApiTools\OAuth2\Factory;

use Laminas\ApiTools\OAuth2\Controller\AuthController;
use Laminas\ApiTools\OAuth2\Factory\AuthControllerFactory;
use Laminas\ApiTools\OAuth2\Provider\UserId\UserIdProviderInterface;
use Laminas\Mvc\Controller\ControllerManager;
use Laminas\ServiceManager\ServiceManager;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

use function method_exists;

class AuthControllerFactoryTest extends AbstractHttpControllerTestCase
{
    /** @var ControllerManager */
    protected $controllers;

    /** @var AuthControllerFactory */
    protected $factory;

    /** @var ServiceManager */
    protected $services;

    public function testControllerCreated()
    {
        $oauthServerFactory = function () {
        };
        $this->services->setService('Laminas\ApiTools\OAuth2\Service\OAuth2Server', $oauthServerFactory);

        $userIdProvider = $this->getMockBuilder(UserIdProviderInterface::class)
            ->getMock();
        $this->services->setService('Laminas\ApiTools\OAuth2\Provider\UserId', $userIdProvider);

        $controller       = $this->isV2ServiceManager($this->services)
            ? $controller = $this->factory->createService($this->controllers)
            : $controller = $this->factory->__invoke($this->services, AuthController::class);

        $this->assertInstanceOf(AuthController::class, $controller);
        $this->assertEquals(new AuthController($oauthServerFactory, $userIdProvider), $controller);
    }

    protected function setUp(): void
    {
        $this->factory = new AuthControllerFactory();

        $this->services = $services = new ServiceManager();

        $this->services->setService('config', [
            'api-tools-oauth2' => [
                'api_problem_error_response' => true,
            ],
        ]);
        $sm = new ServiceManager();
        $sm->setService('ServiceManager', $services);

        $this->controllers = $controllers = new ControllerManager($this->services);

        $this->setApplicationConfig([
            'modules'                  => [
                'Laminas\ApiTools\OAuth2',
            ],
            'module_listener_options'  => [
                'module_paths'      => [__DIR__ . '/../../'],
                'config_glob_paths' => [],
            ],
            'service_listener_options' => [],
            'service_manager'          => [],
        ]);
        parent::setUp();
    }

    /**
     * @param ServiceManager $services
     * @return bool
     */
    protected function isV2ServiceManager($services)
    {
        return ! method_exists($services, 'configure');
    }
}
