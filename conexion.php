<?php
    $pass = "mssqlserverw10";
    $user = "sa";
    $db = "proyecto_db2";
    # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
    $host = "192.168.0.25";
    try {
        $conexion = new PDO("sqlsrv:server=$host;database=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "conectado";
    } catch (Exception $e) {
        echo "Ocurrió un error al conectar con la base de datos: " . $e->getMessage();
    }
?>

