<?php

namespace System\DataBase\DBBuilder;

use Exception;
use System\Config\Config;
use System\DataBase\DBconection\DBConnection;

class DBBuilder
{

    public function __construct()
    {


        $this->createtabel();
        die("migration run ssecssefully");
    }


    private function getMigrations()
    {


        $oldmigrationarray = $this->getOldMigration();
        $basdirectory =  Config::get('app.base_dir') . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "migrations" . DIRECTORY_SEPARATOR;
        $allmigrationarray = glob($basdirectory . "*.php");
        $newmigrationarray = array_diff($allmigrationarray, $oldmigrationarray);
        $this->putOldMigration($allmigrationarray);




        $sqlcodarray = [];
        foreach ($newmigrationarray as $filname) {

            $sqlcod = require $filname;
            array_push($sqlcodarray, $sqlcod[0]);
        }
        return $sqlcodarray;
    }

    private function getOldMigration()
    {

        $data = file_get_contents(__DIR__ . "/OldTabel.db");
        return empty($data) ? [] : unserialize($data);
    }

    private function putOldMigration($value)
    {


        file_put_contents(__DIR__ . '/Oldtabel.db', serialize($value));
    }


    private function createtabel()
    {



        $migrations = $this->getMigrations();
        $pdoinstans = DBConnection::getDBConnectionInstance();
        foreach ($migrations as $migration) {

            $statment = $pdoinstans->prepare($migration);
            $statment->execute();
        }


        return true;
    }
}
