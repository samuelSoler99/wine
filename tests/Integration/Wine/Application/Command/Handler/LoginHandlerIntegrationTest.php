<?php

namespace App\Tests\Integration\Wine\Application\Command\Handler;

use App\Tests\Integration\Wine\Infrastructure\PhpUnit\WineIntegrationTestCase;
use App\Tests\Mother\Wine\Application\Command\LoginMother;
use App\Wine\Application\Command\Handler\LoginHandler;

class LoginHandlerIntegrationTest extends WineIntegrationTestCase
{
    private LoginHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->service(LoginHandler::class);
    }

    public function testHandle(): void
    {
        $login = $this->handler->handle(LoginMother::create('ssoler@gmail.com', 'abc123abc'));
        $this->assertTrue($login);
    }
}