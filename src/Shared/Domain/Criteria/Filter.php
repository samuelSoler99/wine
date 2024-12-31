<?php
namespace App\Shared\Domain\Criteria;

final class Filter
{
    private string $field;
    private $value;

    private function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public static function fromValues(string $field, $value): self
    {
        return new self($field, $value);
    }

    public function field(): string
    {
        return $this->field;
    }

    public function value()
    {
        return $this->value;
    }
}
