<?php

namespace App\Wine\Application\Command;

final readonly class Login
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }
}