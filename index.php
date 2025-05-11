<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio - Sistema de Préstamos</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #7EE8FA, #EEC0C6);
      padding: 40px;
    }
    .menu {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    .menu a {
      display: block;
      padding: 10px;
      margin: 10px 0;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .menu a:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
      box-shadow: 0 6px 10px rgba(0,0,0,0.2);
    }
    footer {
      color: white;
      margin-top: 30px;
      text-align: center;
    }
  </style>
</head>
<body>
<?php
date_default_timezone_set('America/Mexico_City');
$hora = date('H');
$saludo = ($hora < 12) ? 'Buenos días' : (($hora < 19) ? 'Buenas tardes' : 'Buenas noches');
?>

<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">💰 Sistema de Préstamos</span>
  </div>
</nav>

<div class="menu">
  <h2 class="text-center mb-3"><?= $saludo ?>, bienvenido al sistema</h2>

  <!-- Alerta de ejemplo -->
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>¡Éxito!</strong> El sistema está listo para usarse.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <a href="dashboard.php" data-bs-toggle="tooltip" title="Ver panel de control">📊 Dashboard</a>
  <a href="nuevo_prestamo.php" data-bs-toggle="tooltip" title="Registrar un nuevo préstamo">➕ Registrar nuevo préstamo</a>
  <a href="listar_prestamos.php" data-bs-toggle="tooltip" title="Ver lista de préstamos">📄 Ver préstamos</a>
  <a href="editar_eliminar_prestamo.php" data-bs-toggle="tooltip" title="Editar o eliminar préstamos">✏️ Editar / Eliminar préstamos</a>
  <a href="usuarios.php" data-bs-toggle="tooltip" title="Administrar usuarios">👥 Usuarios</a>
  <a href="equipos.php" data-bs-toggle="tooltip" title="Administrar equipos">💻 Equipos</a>
  <a href="salas.php" data-bs-toggle="tooltip" title="Administrar salas">🏫 Salas</a>
</div>

<footer>
  &copy; 2025 Sistema de Préstamos UDI | Hora actual: <span id="hora"></span>
</footer>

<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Hora en tiempo real -->
<script>
  function actualizarHora() {
    const ahora = new Date();
    document.getElementById('hora').textContent = ahora.toLocaleTimeString();
  }
  setInterval(actualizarHora, 1000);
  actualizarHora();
</script>

<!-- Inicializar tooltips -->
<script>
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>
</body>
</html>
