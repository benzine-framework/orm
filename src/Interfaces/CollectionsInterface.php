<?php

namespace Benzine\ORM\Interfaces;

use Laminas\Db\ResultSet\ResultSet;

interface CollectionsInterface
{
    public function fromResultSet(ResultSet $resultSet) : CollectionsInterface;
}