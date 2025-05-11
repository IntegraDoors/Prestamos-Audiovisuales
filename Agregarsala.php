if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_sala'])) {
    $nombre = $_POST['nombre_sala'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $sql = "INSERT INTO salas (nombre, ubicacion, capacidad) VALUES ('$nombre', '$ubicacion', '$capacidad')";
    $conn->query($sql);
}
