<?php
namespace Benzine\ORM;

use Benzine\App;
use Benzine\ORM\Connection\Database;
use Benzine\ORM\Connection\Databases;

class Transaction{

    public static function Begin(){
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);
        /** @var Database $database */
        foreach($databases as $database){
            $database->getAdapter()->getDriver()->getConnection()->beginTransaction();
        }
    }

    public static function Commit(){
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);
        /** @var Database $database */
        foreach($databases as $database){
            $database->getAdapter()->getDriver()->getConnection()->commit();
        }
    }

    public static function Rollback(){
        /** @var Databases $databases */
        $databases = App::Instance()->get(Databases::class);
        /** @var Database $database */
        foreach($databases as $database){
            $database->getAdapter()->getDriver()->getConnection()->rollback();
        }
    }
}
