<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];

$sql = "INSERT INTO equipos (nombre, tipo) VALUES ('$nombre', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "Equipo creado con éxito";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>