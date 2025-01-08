<?php

namespace App\Wine\Domain\ViewModel;

use App\Wine\Domain\Entity\Wine;

class WineView
{
    /**
     * @param MeasurementView[] $measurementView
     */
    private function __construct(
        private string $id,
        private string $name,
        private int $year,
        private array $measurementView,
    ) {
    }

    public static function create(Wine $wine, array $measurementView): self
    {
        return new static(
            $wine->id()->value,
            $wine->name()->value,
            $wine->year()->value,
            $measurementView
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function year(): int
    {
        return $this->year;
    }

    /**
     * @return MeasurementView[]
     */
    public function measurementView(): array
    {
        return $this->measurementView;
    }
}