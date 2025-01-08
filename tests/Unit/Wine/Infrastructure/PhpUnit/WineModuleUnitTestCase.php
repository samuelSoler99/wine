<?php

namespace App\Tests\Unit\Wine\Infrastructure\PhpUnit;

use App\Tests\Unit\Shared\SharedModuleUnitTestCase;
use App\Wine\Domain\Entity\Sensor;
use App\Wine\Domain\Entity\User;
use App\Wine\Domain\Entity\Wine;
use App\Wine\Domain\Exception\SensorNotFound;
use App\Wine\Domain\Exception\UserNotFound;
use App\Wine\Domain\Repository\SensorRepository;
use App\Wine\Domain\Repository\UserRepository;
use App\Wine\Domain\Repository\WineRepository;
use App\Wine\Domain\Service\GetOneSensorByCriteria;
use App\Wine\Domain\Service\GetOneUserByCriteria;
use App\Wine\Domain\Service\GetOneWineByCriteria;
use Mockery\MockInterface;

class WineModuleUnitTestCase extends SharedModuleUnitTestCase
{
    private UserRepository $userRepository;
    private SensorRepository $sensorRepository;
    private GetOneUserByCriteria $getOneUserByCriteria;
    private GetOneSensorByCriteria $getOneSensorByCriteria;
    private WineRepository $wineRepository;
    private GetOneWineByCriteria $getOneWineByCriteria;

    public function wineRepository(): WineRepository|MockInterface
    {
        if (empty($this->wineRepository)) {
            $this->wineRepository = $this->mock(WineRepository::class);
        }

        return $this->wineRepository;
    }

    public function getOneWineByCriteria(): GetOneWineByCriteria|MockInterface
    {
        if (empty($this->getOneWineByCriteria)) {
            $this->getOneWineByCriteria = $this->mock(GetOneWineByCriteria::class);
        }

        return $this->getOneWineByCriteria;
    }

    public function shouldWineRepositoryFindOneBy(?Wine $wine): void
    {
        $this->wineRepository()
            ->shouldReceive('findOneBy')
            ->once()
            ->andReturn($wine);
    }

    public function sensorRepository(): SensorRepository|MockInterface
    {
        if (empty($this->sensorRepository)) {
            $this->sensorRepository = $this->mock(SensorRepository::class);
        }

        return $this->sensorRepository;
    }

    public function getOneSensorByCriteria(): GetOneSensorByCriteria|MockInterface
    {
        if (empty($this->getOneSensorByCriteria)) {
            $this->getOneSensorByCriteria = $this->mock(GetOneSensorByCriteria::class);
        }

        return $this->getOneSensorByCriteria;
    }

    public function shouldSensorRepositoryFindOneBy(?Sensor $sensor): void
    {
        $this->sensorRepository()
            ->shouldReceive('findOneBy')
            ->once()
            ->andReturn($sensor);
    }

    public function shouldGetOneSensorByCriteriaThrowException(): void
    {
        $this->getOneSensorByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andThrow(SensorNotFound::class);
    }

    public function shouldSensorRepositoryCreate(): void
    {
        $this->sensorRepository()
            ->shouldReceive('save')
            ->once();
    }

    public function shouldGetOneSensorByCriteria(Sensor $sensor): void
    {
        $this->getOneSensorByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andReturn($sensor);
    }

    /**
     * @param Sensor[] $sensors
     */
    public function shouldSensorRepositoryFindAllOrderedByName(array $sensors): void
    {
        $this->sensorRepository()
            ->shouldReceive('findAllOrderedByName')
            ->once()
            ->andReturn($sensors);
    }

    public function userRepository(): UserRepository|MockInterface
    {
        if (empty($this->userRepository)) {
            $this->userRepository = $this->mock(UserRepository::class);
        }

        return $this->userRepository;
    }

    public function shouldUserRepositoryFindOneBy(?User $user): void
    {
        $this->userRepository()
            ->shouldReceive('findOneBy')
            ->once()
            ->andReturn($user);
    }

    public function getOneUserByCriteria(): GetOneUserByCriteria|MockInterface
    {
        if (empty($this->getOneUserByCriteria)) {
            $this->getOneUserByCriteria = $this->mock(GetOneUserByCriteria::class);
        }
        return $this->getOneUserByCriteria;
    }

    public function shouldGetOneUserByCriteria(User $user): void
    {
        $this->getOneUserByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andReturn($user);
    }

    public function shouldGetOneUserByCriteriaThrowException(): void
    {
        $this->getOneUserByCriteria()
            ->shouldReceive('execute')
            ->once()
            ->andThrow(UserNotFound::class);
    }
}