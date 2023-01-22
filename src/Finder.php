<?php
namespace Benzine\ORM;

use Benzine\ORM\Exception\BenzineOrmException;
use Laminas\Db\Sql\Predicate\PredicateSet;

class Finder extends \Laminas\Db\Sql\Where
{
    public function __construct(
        ?array $predicates = null,
        $defaultCombination = self::COMBINED_BY_AND,
        private ?int $offset = null,
        private ?int $limit = null,
        private ?string $order = null,
        private string $orderDirection = 'ASC',
    ){
        parent::__construct($predicates, $defaultCombination);
    }

    public static function Where(){
        return new self();
    }


    public function getOffset()
    {
        return $this->offset;
    }


    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }


    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getOrder() : ?string
    {
        if($this->order)
            return "{$this->order} {$this->orderDirection}";
        else
            return null;
    }


    public function orderBy($order, $direction =null)
    {
        $this->order = $order;
        if($direction)
            $this->orderDirection($direction);
        return $this;
    }


    /**
     * @param string $orderDirection
     * @return Finder
     */
    public function orderDirection(string $orderDirection): Finder
    {
        if(!in_array($orderDirection, ['desc','asc'])){
            throw new BenzineOrmException(sprintf("Order direction must be one of 'desc' or 'asc', given '%s'", $orderDirection));
        }
        $this->orderDirection = $orderDirection;
        return $this;
    }



}