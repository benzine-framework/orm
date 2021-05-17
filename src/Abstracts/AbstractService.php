<?php

namespace Benzine\ORM\Abstracts;

use Benzine\ORM\Interfaces\CollectionsInterface;
use Benzine\ORM\TabularData;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql;
use Laminas\Db\Sql\Select;

abstract class AbstractService
{
    abstract public function getNewModelInstance(): AbstractModel;

    abstract public function getTermPlural(): string;

    abstract public function getTermSingular(): string;

    /**
     * @param null|array|\Closure[]      $wheres
     * @param null|Sql\Expression|string $order
     *
     * @return CollectionsInterface
     */
    public function getAll(
        int $limit = null,
        int $offset = null,
        array $wheres = null,
        $order = null,
        string $orderDirection = null
    ): CollectionsInterface {
        /** @var AbstractTableGateway $tableGateway */
        $tableGateway = $this->getNewTableGatewayInstance();
        [$matches, $count] = $tableGateway->fetchAll(
            $limit,
            $offset,
            $wheres,
            $order,
            null !== $orderDirection ? $orderDirection : Sql\Select::ORDER_ASCENDING
        );

        $collection = $this->getNewCollectionInstance();

        if ($matches instanceof ResultSet) {
            $collection->fromResultSet($matches);
        }

        return $collection;
    }

    /**
     * @param null|string           $distinctColumn
     * @param null|array|\Closure[] $wheres
     *
     * @return AbstractCollection
     */
    public function getDistinct(
        string $distinctColumn,
        array $wheres = null
    ): AbstractCollection {
        /** @var AbstractTableGateway $tableGateway */
        $tableGateway = $this->getNewTableGatewayInstance();
        [$matches, $count] = $tableGateway->fetchDistinct(
            $distinctColumn,
            $wheres
        );

        $collection = $this->getNewCollectionInstance();

        if ($matches instanceof ResultSet) {
            $collection->fromResultSet($matches);
        }

        return $collection;
    }

    /**
     * @param null|array|\Closure[] $wheres
     *
     * @return int
     */
    public function countAll(
        array $wheres = null
    ): int {
        /** @var AbstractTableGateway $tableGateway */
        $tableGateway = $this->getNewTableGatewayInstance();

        return $tableGateway->getCount($wheres);
    }

    /**
     * @return Benzine\ORM\Abstracts\Model[]
     */
    public function search(Sql\Where $where, int $limit = null, int $offset = null): \Generator
    {
        $tableGateway = $this->getNewTableGatewayInstance();

        $select = $tableGateway->getSql()->select();
        $select->where($where);
        if ($limit) {
            $select->limit($limit);
        }
        if ($offset) {
            $select->offset($offset);
        }
        $matches = $tableGateway->selectWith($select);
        if ($matches instanceof ResultSet) {
            foreach ($matches as $match) {
                yield $match;
            }
        }
    }

    public function getTabularData(): TabularData\Table
    {
        return new TabularData\Table($this);
    }

    abstract public function getByField(string $field, $value, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING): ?AbstractModel;

    abstract public function getManyByField(string $field, $value, int $limit = null, int $offset = null, $orderBy = null, $orderDirection = Select::ORDER_ASCENDING): AbstractCollection;

    abstract public function countByField(string $field, $value): int;

    abstract public function getRandom(): ?AbstractModel;

    abstract protected function getNewTableGatewayInstance(): AbstractTableGateway;

    abstract protected function getNewCollectionInstance(): AbstractCollection;
}
