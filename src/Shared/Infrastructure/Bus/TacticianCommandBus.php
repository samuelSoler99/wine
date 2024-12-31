<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Domain\Bus\CommandBus;
use League\Tactician\CommandBus as LeagueTacticianCommandBus;

class TacticianCommandBus implements CommandBus
{
    public function __construct(private LeagueTacticianCommandBus $commandBus)
    {
    }

    public function handle(object $command)
    {
        return $this->commandBus->handle($command);
    }
}