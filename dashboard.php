<?php
$conn = new mysqli('localhost', 'root', '', 'prestamos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$usuarios = $conn->query("SELECT COUNT(*) AS total FROM usuarios")->fetch_assoc()['total'];
$equipos = $conn->query("SELECT COUNT(*) AS total FROM equipos WHERE disponible = 1")->fetch_assoc()['total'];
$salas = $conn->query("SELECT COUNT(*) AS total FROM salas WHERE ocupada = 1")->fetch_assoc()['total'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Sistema de Préstamos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      padding: 40px;
    }
    .card {
      margin: 15px 0;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border-radius: 15px;
    }
    .card .card-title {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }
    .card .card-text {
      font-size: 2.5rem;
      font-weight: bold;
    }
    .fa-icon {
      font-size: 2rem;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">📊 Dashboard</span>
    <a href="index.php" class="btn btn-light">🏠 Inicio</a>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card text-white bg-primary">
        <div class="card-body text-center">
          <i class="fas fa-users fa-icon"></i>
          <h5 class="card-title">Usuarios registrados</h5>
          <p class="card-text"><?= $usuarios ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-success">
        <div class="card-body text-center">
          <i class="fas fa-laptop fa-icon"></i>
          <h5 class="card-title">Equipos disponibles</h5>
          <p class="card-text"><?= $equipos ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-warning">
        <div class="card-body text-center">
          <i class="fas fa-door-closed fa-icon"></i>
          <h5 class="card-title">Salas ocupadas</h5>
          <p class="card-text"><?= $salas ?></p>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="card mt-4">
  <div class="card-body">
    <canvas id="prestamosChart"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('prestamosChart').getContext('2d');
const prestamosChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Usuarios', 'Equipos Disponibles', 'Salas Ocupadas'],
        datasets: [{
            label: 'Resumen',
            data: [<?= $usuarios ?>, <?= $equipos ?>, <?= $salas ?>],
            backgroundColor: ['#0d6efd', '#198754', '#ffc107']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Resumen general del sistema'
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>