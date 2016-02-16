<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'conge',
    'user'     => 'root',
    'password' => 'root',
);

$app['debug'] = true;