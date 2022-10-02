
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manuales</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Manuales del sistema y del usuario</h1>
    <span><a href="buscarCliente.php">Buscar Cliente</a></span>  <br>
    <span><a href="bitacora_usuarios.php">Bitácora de Usuarios</a></span>  <br><br><br><hr>

    <form action="vermanuales.php" method="POST">
      <input type="submit" value="Manual del Sistema (PDF)">
      <input type="submit" value="Manual del Usuario (PDF)">
    </form>

  </body>
</html>
