<?php
$conn = new mysqli('localhost', 'root', '', 'prestamos');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $equipo = $_POST['equipo'];
    $sala = $_POST['sala'];

    $sql = "INSERT INTO prestamos (usuario, equipo, sala) VALUES ('$usuario', '$equipo', '$sala')";
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
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Usuario</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Equipo</label>
      <input type="text" name="equipo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Sala</label>
      <input type="text" name="sala" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
  </form>
</div>
</body>
</html>
