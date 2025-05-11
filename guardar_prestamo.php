$conexion = new mysqli('localhost', 'root', '', 'tu_basededatos');
$sql = "INSERT INTO prestamos (id_usuario, id_equipo, fecha_prestamo, fecha_devolucion)
        VALUES ('$usuario', '$equipo', '$fecha_prestamo', '$fecha_devolucion')";
$conexion->query($sql);
