<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-oauth2 for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-oauth2/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

use Laminas\ApiTools\OAuth2\Adapter\PdoAdapter;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use ReflectionException;
use ReflectionProperty;

use function file_get_contents;

abstract class AbstractBaseTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../TestAsset/pdo.application.config.php'
        );

        parent::setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $serviceManager->setAllowOverride(true);
    }

    /**
     * @return array[]
     * @throws ReflectionException
     */
    public function provideStorage()
    {
        $this->setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $pdo            = $serviceManager->get(PdoAdapter::class);

        $r = new ReflectionProperty($pdo, 'db');
        $r->setAccessible(true);
        $db = $r->getValue($pdo);

        $sql = file_get_contents(__DIR__ . '/../../TestAsset/database/pdo.sql');
        $db->exec($sql);

        return [[$pdo]];
    }
}
