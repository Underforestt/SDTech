<?php

namespace SDTech\DB;
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

    public $capsule;

    public function __clone(){}

    function __construct() {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            "driver" => DBDRIVER,
            "host" => DBHOST,
            "database" => DBNAME,
            "username" => DBUSER,
            "password" => DBPASS,
            "charset" => "utf8",
            "collation" => "utf8_unicode_ci",
            "prefix" => "",
        ]);

    }

    public function boot(){
        $this->capsule->bootEloquent();
    }
}

function clientCode()
{
    $p1 = new Database();

    $p2 = clone $p1;
    if ($p1->capsule === $p2->capsule) {
        echo "Primitive field values have been carried over to a clone. Yay!\n";
    } else {
        echo "Primitive field values have not been copied. Booo!\n";
    }
}

clientCode();