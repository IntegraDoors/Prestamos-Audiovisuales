if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_usuario'])) {
    $nombre = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $sql = "INSERT INTO usuarios (nombre, correo, tipo_usuario) VALUES ('$nombre', '$correo', '$tipo_usuario')";
    $conn->query($sql);
}
