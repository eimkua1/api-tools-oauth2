<?php

/**
 * FIXME:  This adapter logic is not supported in the PDO adapter
 */

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

class JwtBearerTest extends AbstractBaseTest
{
    /** @dataProvider provideStorage */
    public function testGetClientKey()
    {
        $this->assertFalse(false);
    }
}
