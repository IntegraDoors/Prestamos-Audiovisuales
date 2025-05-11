<?php
$conn = new mysqli('localhost', 'root', '', 'prestamos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $equipo_id = $_POST['equipo_id'];
    $sala_id = $_POST['sala_id'];

    $sql = "INSERT INTO prestamos (usuario_id, equipo_id, sala_id) VALUES ('$usuario_id', '$equipo_id', '$sala_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Préstamo registrado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al registrar: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Préstamo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Registrar Nuevo Préstamo</h1>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Usuario ID</label>
            <input type="number" name="usuario_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Equipo ID</label>
            <input type="number" name="equipo_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sala ID</label>
            <input type="number" name="sala_id" class="form-control" required>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
            <a href="index.php" class="btn btn-secondary ms-2">🏠 Volver al Inicio</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
