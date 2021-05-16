<?php

namespace Benzine\ORM;

use Laminas\Db\Adapter\Platform;
use Laminas\Db\Adapter\Profiler;
use Laminas\Db\ResultSet;
use Laminas\Db\Adapter\Adapter as LaminasAdapter;
use Benzine\ORM\Profiler\Profiler as BenzineProfiler;

class Adapter extends LaminasAdapter
{
    public function __construct($driver, Platform\PlatformInterface $platform = null, ResultSet\ResultSetInterface $queryResultPrototype = null, Profiler\ProfilerInterface $profiler = null)
    {
        parent::__construct($driver, $platform, $queryResultPrototype, $profiler);
        //if (!defined('ZEND_PROFILER_DISABLE') || ZEND_PROFILER_DISABLE == false) {
        //    $this->setProfiler(App::Container()->get(BenzineProfiler::class));
        //}
    }
}
