<?php

declare(strict_types=1);

namespace Benzine\ORM\Interfaces;

interface ModelInterface
{
    public function __toPublicArray(): array;

    public function __fromPublicArray(array $publicArray): self;

    public static function factory();

    public function save();

    public function isDirty(): bool;

    public function destroy(): int;

    public function destroyRecursively(): int;

    public function getListOfProperties(): array;

    public function exchangeArray(array $data): self;
}
