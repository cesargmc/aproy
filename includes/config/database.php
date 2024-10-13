<?php

function conectarDB() : mysqli {
    var_dump($_ENV);
    $db = mysqli_connect(
        $_ENV['DB_HOST'] ?? 'localhost',
        $_ENV['DB_USER'] ?? 'root',
        $_ENV['DB_PASS'] ?? 'root',
        $_ENV['DB_NAME'] ?? 'travel_crud'
    );

    $db->set_charset('utf8');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}