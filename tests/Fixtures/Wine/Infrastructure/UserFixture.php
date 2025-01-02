<?php

namespace App\Tests\Fixtures\Wine\Infrastructure;

use App\Tests\Mother\Shared\Domain\ValueObject\StringValueObjectMother;
use App\Tests\Mother\Shared\Domain\ValueObject\UuidMother;
use App\Tests\Mother\Wine\Domain\Entity\UserMother;
use App\Tests\Mother\Wine\Domain\ValueObject\UserPasswordMother;
use App\Wine\Domain\Repository\UserRepository;

class UserFixture
{
    public const USUARIO_1_ID = 'afb59190-4deb-11ed-bdc3-0242ac120002';
    public const USUARIO_1_NAME = 'samu';
    public const USUARIO_1_LAST_NAME = 'soler';
    public const USUARIO_1_EMAIL = 'ssoler@gmail.com';
    public const USUARIO_1_PASSWORD_HASHED = 'abc123abc';

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function load()
    {

        $this->userRepository->save(
            (new UserMother())->randomize()
                ->withUuid(UuidMother::create(self::USUARIO_1_ID))
                ->withName(StringValueObjectMother::create(self::USUARIO_1_NAME))
                ->withLastName(StringValueObjectMother::create(self::USUARIO_1_LAST_NAME))
                ->withEmail(StringValueObjectMother::create(self::USUARIO_1_EMAIL))
                ->withPassword(UserPasswordMother::create(self::USUARIO_1_PASSWORD_HASHED))
                ->instantiate()
        );

        $this->userRepository->save(
            (new UserMother())->randomize()->instantiate()
        );
    }

    public function purge()
    {
        $this->userRepository->deleteAll();
    }
}