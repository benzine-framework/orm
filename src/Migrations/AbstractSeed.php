<?php

declare(strict_types=1);

namespace Benzine\ORM\Migrations;

use Benzine\ORM\Tests\App;
use Faker\Generator;
use Monolog\Logger;

abstract class AbstractSeed extends \Phinx\Seed\AbstractSeed
{
    protected Generator $faker;
    protected Logger $log;

    public function __construct()
    {
        $this->faker = App::Instance()->get(Generator::class);
        $this->log   = App::Instance()->get(Logger::class);
    }
}
