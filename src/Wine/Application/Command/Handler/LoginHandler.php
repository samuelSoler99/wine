<?php

namespace App\Wine\Application\Command\Handler;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filters;
use App\Shared\Domain\ValueObject\StringValueObject;
use App\Wine\Application\Command\Login;
use App\Wine\Domain\Exception\UserNotFound;
use App\Wine\Domain\Service\GetOneUserByCriteria;

class LoginHandler
{
    public function __construct(
        private GetOneUserByCriteria $getOneUserByCriteria
    ) {
    }

    public function handle(Login $command): bool
    {
        try {
            $this->getOneUserByCriteria->execute(
                Criteria::create(
                    Filters::fromValues(
                        [
                            'email' => StringValueObject::fromString($command->email),
                            'password' => StringValueObject::fromString($command->password)
                        ],
                    )
                )
            );
            return true;
        } catch (UserNotFound $exception) {
            return false;
        }
    }
}