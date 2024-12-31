<?php

namespace App\Shared\Domain\Bus;

interface CommandBus
{
    public function handle(object $command);
}