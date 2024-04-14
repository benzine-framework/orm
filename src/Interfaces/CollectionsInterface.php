<?php

declare(strict_types=1);

namespace Benzine\ORM\Interfaces;

use Laminas\Db\ResultSet\ResultSet;

interface CollectionsInterface
{
    public function fromResultSet(ResultSet $resultSet): CollectionsInterface;
}
