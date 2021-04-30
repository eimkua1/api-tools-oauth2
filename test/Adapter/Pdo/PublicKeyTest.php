<?php

/**
 * FIXME:  This adapter logic is not supported in the PDO adapter
 */

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

class PublicKeyTest extends AbstractBaseTest
{
    /**
     * @dataProvider provideStorage
     */
    public function testSetAccessToken()
    {
        $this->assertFalse(false);
    }
}
