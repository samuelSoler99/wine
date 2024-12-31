<?php

namespace App\Tests\Unit\Wine\Application\Command\Handler;

use App\Tests\Mother\Wine\Application\Command\LoginMother;
use App\Tests\Mother\Wine\Domain\Entity\UserMother;
use App\Tests\Unit\Wine\Infrastructure\PhpUnit\WineModuleUnitTestCase;
use App\Wine\Application\Command\Handler\LoginHandler;

class LoginHandlerTest extends WineModuleUnitTestCase
{
    private LoginHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new LoginHandler(
            $this->getOneUserByCriteria()
        );
    }

    public function testHandle(): void
    {
        $loginCommand = LoginMother::random();
        $this->shouldGetOneUserByCriteria(UserMother::random());
        $login = $this->handler->handle($loginCommand);
        $this->assertTrue($login);
    }

    public function testHandleFalse(): void
    {
        $loginCommand = LoginMother::random();
        $this->shouldGetOneUserByCriteriaThrowException();
        $login = $this->handler->handle($loginCommand);
        $this->assertFalse($login);
    }
}