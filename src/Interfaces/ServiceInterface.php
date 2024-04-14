<?php

declare(strict_types=1);

namespace Benzine\ORM\Interfaces;

use Laminas\Db\Sql\Expression;

interface ServiceInterface
{
    /**
     * @param null|Expression|string $order
     *
     * @return ModelInterface[]
     */
    public function getAll(
        ?int $limit = null,
        ?int $offset = null,
        ?array $wheres = null,
        $order = null,
        ?string $orderDirection = null
    );

    public function getByField(string $field, $value);

    public function getRandom();
}
