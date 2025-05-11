<?php
$conn = new mysqli('localhost', 'root', '', 'prestamos');
$result = $conn->query("SELECT * FROM prestamos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Préstamos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h1 class="mb-4">Lista de Préstamos</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Equipo</th>
        <th>Sala</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['usuario'] ?></td>
        <td><?= $row['equipo'] ?></td>
        <td><?= $row['sala'] ?></td>
        <td><?= $row['fecha'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
