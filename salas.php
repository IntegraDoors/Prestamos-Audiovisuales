<?php
include 'conexion.php';

// Agregar sala
if (isset($_POST['agregar'])) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $conn->query("INSERT INTO salas (nombre) VALUES ('$nombre')");
    header("Location: salas.php");
    exit;
}

// Eliminar sala
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM salas WHERE id = $id");
    header("Location: salas.php");
    exit;
}

// Editar sala
if (isset($_POST['editar'])) {
    $id = intval($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $conn->query("UPDATE salas SET nombre='$nombre' WHERE id=$id");
    header("Location: salas.php");
    exit;
}

$resultado = $conn->query("SELECT * FROM salas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Salas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <nav class="mb-4">
        <a href="usuarios.php" class="btn btn-outline-primary">Usuarios</a>
        <a href="equipos.php" class="btn btn-outline-primary">Equipos</a>
        <a href="salas.php" class="btn btn-outline-primary">Salas</a>
        <a href="editar_eliminar_prestamo.php" class="btn btn-outline-primary">Préstamos</a>
    </nav>

    <h2>Salas</h2>

    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nueva sala" required>
            <button type="submit" name="agregar" class="btn btn-primary">➕ Agregar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <?php if (isset($_GET['editar']) && $_GET['editar'] == $row['id']): ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><input type="text" name="nombre" class="form-control" value="<?= $row['nombre'] ?>"></td>
                        <td>
                            <button type="submit" name="editar" class="btn btn-success btn-sm">💾 Guardar</button>
                            <a href="salas.php" class="btn btn-secondary btn-sm">❌ Cancelar</a>
                        </td>
                    </tr>
                </form>
            <?php else: ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td>
                        <a href="?editar=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar sala?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
