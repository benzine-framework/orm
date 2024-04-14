<?php

declare(strict_types=1);

namespace Benzine\ORM;

use Benzine\ORM\Profiler\Profiler as BenzineProfiler;
use Laminas\Db\Adapter\Adapter as LaminasAdapter;
use Laminas\Db\Adapter\Platform;
use Laminas\Db\Adapter\Profiler;
use Laminas\Db\ResultSet;

class Adapter extends LaminasAdapter
{
    public function __construct($driver, ?Platform\PlatformInterface $platform = null, ?ResultSet\ResultSetInterface $queryResultPrototype = null, ?Profiler\ProfilerInterface $profiler = null)
    {
        parent::__construct($driver, $platform, $queryResultPrototype, $profiler);
        // if (!defined('ZEND_PROFILER_DISABLE') || ZEND_PROFILER_DISABLE == false) {
        //    $this->setProfiler(App::Container()->get(BenzineProfiler::class));
        // }
    }
}
