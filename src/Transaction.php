<?php

declare(strict_types=1);

namespace Benzine\ORM;

use Benzine\App;
use Benzine\ORM\Connection\Database;
use Benzine\ORM\Connection\Databases;

class Transaction
{
    public static function Begin(): void
    {
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);

        /** @var Database $database */
        foreach ($databases as $database) {
            $database->getAdapter()->getDriver()->getConnection()->beginTransaction();
        }
    }

    public static function Commit(): void
    {
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);

        /** @var Database $database */
        foreach ($databases as $database) {
            $database->getAdapter()->getDriver()->getConnection()->commit();
        }
    }

    public static function Rollback(): void
    {
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);

        /** @var Database $database */
        foreach ($databases as $database) {
            $database->getAdapter()->getDriver()->getConnection()->rollback();
        }
    }
}
