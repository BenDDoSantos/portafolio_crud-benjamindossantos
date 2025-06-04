<?php
include 'auth.php';
include 'db.php';
$result = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portafolio CRUD</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container container-index">
    <div class="navbar">
        <a href="add.php">+ Agregar Proyecto</a>
        <a href="logout.php">Cerrar sesión</a>
    </div>
    <h2>Proyectos</h2>
    <div class="proyectos-grid">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="proyecto">
        <h3><?= $row['titulo'] ?></h3>
        <p><?= $row['descripcion'] ?></p>
        <img src="uploads/<?= $row['imagen'] ?>" width="150"><br>
        <a href="<?= $row['url_github'] ?>">GitHub</a>
        <a href="<?= $row['url_produccion'] ?>">Enlace</a><br>
        <a href="edit.php?id=<?= $row['id'] ?>">Editar</a>
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro que quieres eliminar este proyecto?')">Eliminar</a>
      </div>
    <?php endwhile; ?>
    </div>
</div>
</body>
</html>