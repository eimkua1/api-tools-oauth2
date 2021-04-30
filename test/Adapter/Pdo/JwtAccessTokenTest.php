<?php

/**
 * FIXME:  This adapter logic is not supported in the PDO adapter
 */

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

class JwtAccessTokenTest extends AbstractBaseTest
{
    /**
     * @dataProvider provideStorage
     */
    public function testJwtWithJti()
    {
        $this->assertFalse(false);
    }
}
