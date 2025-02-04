<?php

use app\models\ConnectionModel;
use flight\Engine;
use flight\database\PdoWrapper;
use flight\debug\database\PdoQueryCapture;
use Tracy\Debugger;
use app\models\Model;
use app\models\TableauDeBordModel;
use app\models\SoldeModel;
use app\models\AchatVenteModel;
use app\models\AdminAnimalModel;
use app\models\AdminEspeceModel;
use app\models\AnimalsModel;

/** 
 * @var array $config This comes from the returned array at the bottom of the config.php file
 * @var Engine $app
 */
// uncomment the following line for MySQL
$dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['dbname'] . ';charset=utf8mb4';
// uncomment the following line for SQLite
// $dsn = 'sqlite:' . $config['database']['file_path'];
// Uncomment the below lines if you want to add a Flight::db() service
// In development, you'll want the class that captures the queries for you. In production, not so much.
$pdoClass = Debugger::$showBar === true ? PdoQueryCapture::class : PdoWrapper::class;
$app->register('db', $pdoClass, [$dsn, $config['database']['user'] ?? null, $config['database']['password'] ?? null]);
// Got google oauth stuff? You could register that here
// $app->register('google_oauth', Google_Client::class, [ $config['google_oauth'] ]);
// Redis? This is where you'd set that up
// $app->register('redis', Redis::class, [ $config['redis']['host'], $config['redis']['port'] ]);

Flight::map('Model', function () {
    return new Model(Flight::db());
});
Flight::map('TableauDeBordModel', function () {
    return new TableauDeBordModel(Flight::db());
});
Flight::map('SoldeModel', function () {
    return new SoldeModel(Flight::db());
});
Flight::map('AchatVenteModel', function () {
    return new AchatVenteModel(Flight::db());
});
Flight::map('AdminAnimalModel', function () {
    return new AdminAnimalModel(Flight::db());
});
Flight::map('AdminEspeceModel', function () {
    return new AdminEspeceModel(Flight::db());
});
Flight::map('AnimalsModel', function () {
    return new AnimalsModel(Flight::db());
});
