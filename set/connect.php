<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=domain;charset=utf8", 'root', 'root');
} catch (PDOExpception $e) {
    echo $e->getMessage();
}
