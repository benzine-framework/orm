<?php

declare(strict_types=1);

namespace Benzine\ORM\Interfaces;

interface QueryStatisticInterface
{
    public function __toArray(): array;

    public function getCallPoints(): array;

    public function setCallPoints(array $callPoints);

    public function getSql(): string;

    public function setSql(string $sql);

    public function getTime(): float;

    public function setTime(float $time);
}
