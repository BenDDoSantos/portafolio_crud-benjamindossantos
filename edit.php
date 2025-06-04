<?php
include 'auth.php';
include 'db.php';

$id = $_GET['id'];
$proyecto = $conn->query("SELECT * FROM proyectos WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $url_github = $_POST['url_github'];
  $url_produccion = $_POST['url_produccion'];

  if ($_FILES['imagen']['name']) {
    $imagen = $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/$imagen");
    $img_sql = ", imagen='$imagen'";
  } else {
    $img_sql = "";
  }

  $sql = "UPDATE proyectos SET titulo='$titulo', descripcion='$descripcion', url_github='$url_github', url_produccion='$url_produccion' $img_sql WHERE id=$id";
  $conn->query($sql);
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proyecto</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
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
        .img-preview {
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="navbar">
        <a href="index.php">← Volver</a>
    </div>
    <h2>Editar Proyecto</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($proyecto['titulo']) ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($proyecto['descripcion']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="url_github">URL GitHub</label>
            <input type="url" id="url_github" name="url_github" value="<?= htmlspecialchars($proyecto['url_github']) ?>" placeholder="https://github.com/usuario/repositorio">
        </div>
        <div class="form-group">
            <label for="url_produccion">URL Producción</label>
            <input type="url" id="url_produccion" name="url_produccion" value="<?= htmlspecialchars($proyecto['url_produccion']) ?>" placeholder="https://tusitio.com">
        </div>
        <div class="form-group">
            <label for="imagen">Imagen actual</label>
            <div class="img-preview">
                <img src="uploads/<?= htmlspecialchars($proyecto['imagen']) ?>" alt="Imagen actual" width="120" style="border-radius:6px;border:1px solid #ddd;">
            </div>
            <label for="imagen">Cambiar imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
        </div>
        <div class="form-actions">
            <button type="submit">Actualizar</button>
        </div>
    </form>
</div>
</body>
</html>