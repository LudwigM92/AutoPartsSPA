<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['rut'])) {
    $records = $conn->prepare('SELECT rut FROM clientes WHERE rut = :rut');
    $records->bindParam(':rut', $_POST['rut']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if (implode(" ", $results) == $_POST['rut']) {
      //$data = $conn->prepare('SELECT * FROM clientes WHERE rut = :rut');
      $message = "s";
    } else {
      $message = 'cliente NO encontrado';
    }
    //$message = 'SELECT * FROM clientes WHERE rut = :rut';

    
  }else{
    $message = 'Debes ingresar un Rut';
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Buscar Cliente</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Buscar Cliente</h1>
    <span>o <a href="crearCliente.php">Registrar Cliente</a></span>

    <form action="buscarCliente.php" method="POST">
      <input name="rut" type="text" placeholder="ingresa el rut del cliente">
      <input type="submit" value="Ver cliente">
    </form>
    <form action="vertodos.php" method="POST">
      <input type="submit" value="Ver todos">
    </form>

    <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
      <tr>
        <th>Nombre del Cliente</th>
        <th>Rut</th>
        <th>Telefono</th>
        <th>Dirección</th>
        <th>Email</th>
      </tr>
      <tr >
        <td>Carlos</td>
        <td>20132449-1</td>
        <td>+56945222578</td>
        <td>Linares</td>
        <td>carlos@gmail.com</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>
      <!--<tr>
        <td>Juana</td>
        <td>18132449-5</td>
        <td>+56997888521</td>
        <td>Iquique</td>
        <td>juana@gmail.com</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>-->
      <tr>
        <td>Pedro</td>
        <td>14897252-K</td>
        <td>+56972558456</td>
        <td>Rancagua</td>
        <td>pedro@gmail.com</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>
    </table>
  </body>
</html>
