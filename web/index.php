<?php
require(__DIR__ . '/../configs/config.php');
//грузим конфиг БД и, соответственно, коннектимся к ней
$dbObject = new PDO($dbdata['type'] . ':host=' . $dbdata['host'] . ';dbname=' . $dbdata['db'], $dbdata['user'], $dbdata['pass']);
$dbObject->exec('SET CHARACTER SET ' . $dbdata['charset']);

//грузим автолоадер, ввиду "немасштабности проекта, решил не заморачиваться с неймспейсами
require(__DIR__ . '/../application/loader.php');
require(__DIR__ . '/../application/init.php');

//инициализируем аппликейшен
new Application_Init();

