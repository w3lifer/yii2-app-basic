<?php

$db = require_once __DIR__ . '/components/db.php';

// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=localhost;dbname=yii2_basic_tests';

return $db;
