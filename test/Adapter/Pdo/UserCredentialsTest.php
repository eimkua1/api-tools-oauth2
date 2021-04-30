<?php

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

use OAuth2\Storage\UserCredentialsInterface;

class UserCredentialsTest extends AbstractBaseTest
{
    /** @dataProvider provideStorage */
    public function testCheckUserCredentials(UserCredentialsInterface $storage)
    {
        if ($storage instanceof NullStorage) {
            $this->markTestSkipped('Skipped Storage: ' . $storage->getMessage());

            return;
        }

        // correct credentials
        $this->assertTrue($storage->checkUserCredentials('oauth_test_user', 'testpass'));
        // invalid password
        $this->assertFalse($storage->checkUserCredentials('oauth_test_user', 'fakepass'));
        // invalid username
        $this->assertFalse($storage->checkUserCredentials('fakeusername', 'testpass'));

        // invalid username
        $this->assertFalse($storage->getUserDetails('fakeusername'));

        // ensure all properties are set
        $user = $storage->getUserDetails('oauth_test_user');
        $this->assertTrue($user !== false);
        $this->assertArrayHasKey('user_id', $user);
        $this->assertEquals($user['user_id'], 'oauth_test_user');
    }

    /** @dataProvider provideStorage */
    public function testUserClaims()
    {
        // FIXME:  openid not supported
        $this->assertFalse(false);
    }
}
