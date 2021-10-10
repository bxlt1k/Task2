<?php

try {
    $config = require_once 'config.php';
    $db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'], $config['username'], $config['password']);
} catch (PDOException $e) {
    echo $e->getMessage();
}