<?php

declare(strict_types=1);

namespace Benzine\ORM\Entities;

class Table extends AbstractEntity
{
    protected string $tableName;
    protected Column $columns;

    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @return Table
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }
}
