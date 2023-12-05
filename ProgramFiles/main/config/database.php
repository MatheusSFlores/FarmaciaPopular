<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('BASE', 'projeto-farmacia');

try {
    $conn = new mysqli(HOST, USER, PASS, BASE);
} catch (mysqli_sql_exception $e) {
    die($e->getMessage());
}

if ($conn->connect_error) {
    die('Ocorreu um erro ao conectar ao banco de dados: ' . $conn->connect_error);
} else {
    echo 'A conexão com o banco de dados foi bem-sucedida!';
}

$conn->close();
?>
