<?php

declare(strict_types=1);

namespace Benzine\ORM;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;

class LaminatorSql extends Sql
{
    public function __construct(AdapterInterface $adapter, $table = null, $sqlPlatform = null)
    {
        parent::__construct($adapter, $table, $sqlPlatform);
    }
}
