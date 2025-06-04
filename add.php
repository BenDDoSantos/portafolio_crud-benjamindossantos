<?php
include 'auth.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $url_github = $_POST['url_github'];
  $url_produccion = $_POST['url_produccion'];

  $imagen = $_FILES['imagen']['name'];
  $tmp = $_FILES['imagen']['tmp_name'];
  move_uploaded_file($tmp, "uploads/$imagen");

  $sql = "INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) 
          VALUES ('$titulo', '$descripcion', '$url_github', '$url_produccion', '$imagen')";

  $conn->query($sql);
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Proyecto</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos adicionales para el formulario */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }
        .form-group label {
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
        }
        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group input[type="file"],
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }
        .form-group input[type="file"] {
            padding: 4px 0;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="navbar">
        <a href="index.php">← Volver</a>
    </div>
    <h2>Agregar Proyecto</h2>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="url_github">URL GitHub</label>
            <input type="url" id="url_github" name="url_github" placeholder="https://github.com/usuario/repositorio">
        </div>
        <div class="form-group">
            <label for="url_produccion">URL Producción</label>
            <input type="url" id="url_produccion" name="url_produccion" placeholder="https://tusitio.com">
        </div>
        <div class="form-actions">
            <input type="submit" value="Guardar">
        </div>
    </form>
</div>
</body>
</html>