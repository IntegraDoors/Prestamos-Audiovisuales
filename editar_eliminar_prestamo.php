<?php
include 'conexion.php';

// Filtrado
$where = "";
if (!empty($_GET['usuario']) || !empty($_GET['fecha'])) {
    $filtros = [];
    if (!empty($_GET['usuario'])) {
        $usuario = $conn->real_escape_string($_GET['usuario']);
        $filtros[] = "u.nombre LIKE '%$usuario%'";
    }
    if (!empty($_GET['fecha'])) {
        $fecha = $conn->real_escape_string($_GET['fecha']);
        $filtros[] = "p.fecha_prestamo = '$fecha'";
    }
    $where = "WHERE " . implode(" AND ", $filtros);
}

// Eliminar
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM prestamos WHERE id = $id");
    header("Location: editar_eliminar_prestamo.php");
    exit;
}

// Editar
if (isset($_POST['editar'])) {
    $id = intval($_POST['id']);
    $nuevoEquipo = $_POST['equipo'];
    $nuevaFecha = $_POST['fecha'];

    $stmt = $conn->prepare("UPDATE prestamos SET id_equipo=?, fecha_prestamo=? WHERE id=?");
    $stmt->bind_param("isi", $nuevoEquipo, $nuevaFecha, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: editar_eliminar_prestamo.php");
    exit;
}

// Obtener préstamos
$query = "
    SELECT p.id, u.nombre AS usuario, e.nombre AS equipo, p.fecha_prestamo, p.id_equipo
    FROM prestamos p 
    INNER JOIN usuarios u ON p.id_usuario = u.id
    INNER JOIN equipos e ON p.id_equipo = e.id
    $where
";
$resultado = $conn->query($query);
if (!$resultado) {
    die("Error en la consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar/Eliminar Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Filtrar préstamos</h2>
    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-auto">
                <label>Usuario:</label>
                <input type="text" name="usuario" class="form-control" value="<?= $_GET['usuario'] ?? '' ?>">
            </div>
            <div class="col-auto">
                <label>Fecha:</label>
                <input type="date" name="fecha" class="form-control" value="<?= $_GET['fecha'] ?? '' ?>">
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <h2>Lista de préstamos</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Equipo</th>
                <th>Fecha</th>
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
                        <td><?= $row['usuario'] ?></td>
                        <td>
                            <select name="equipo" class="form-select">
                                <?php
                                $res = $conn->query("SELECT id, nombre FROM equipos");
                                while ($eq = $res->fetch_assoc()) {
                                    $sel = $eq['id'] == $row['id_equipo'] ? 'selected' : '';
                                    echo "<option value='{$eq['id']}' $sel>{$eq['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="date" name="fecha" class="form-control" value="<?= $row['fecha_prestamo'] ?>"></td>
                        <td>
                            <button type="submit" name="editar" class="btn btn-success btn-sm">💾 Guardar</button>
                            <a href="editar_eliminar_prestamo.php" class="btn btn-secondary btn-sm">❌ Cancelar</a>
                        </td>
                    </tr>
                </form>
            <?php else: ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['usuario'] ?></td>
                    <td><?= $row['equipo'] ?></td>
                    <td><?= $row['fecha_prestamo'] ?></td>
                    <td>
                        <a href="?editar=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                        <a href="?eliminar=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar préstamo?')">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
