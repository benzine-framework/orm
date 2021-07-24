<?php

namespace Benzine\ORM\Abstracts;

abstract class AbstractCollection
{
    protected array $contained = [];

    public function __toArray() : array {
        return $this->contained;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->contained);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->contained[$offset]);
    }

    public function offsetUnset($offset): void
    {
        $this->unset($this->contained[$offset]);
    }

    public function serialize(): string
    {
        return serialize($this->contained);
    }

    public function unserialize($data): void
    {
        $this->contained = unserialize($data);
    }

    public function count(): int
    {
        return count($this->contained);
    }
}
