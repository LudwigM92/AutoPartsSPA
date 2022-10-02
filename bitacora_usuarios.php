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
    <title>Bitácora de Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Bitácora de Usuarios</h1>
    <span><a href="crearCliente.php">Registrar Cliente</a></span> <br><hr>

    <!--<form action="buscarCliente.php" method="POST">
      <input name="rut" type="text" placeholder="ingresa el rut del cliente">
      <input type="submit" value="Ver cliente">
    </form>-->
    <form action="vertodos.php" method="POST">
        <input type="submit" value="Registrar o editar usuario">
        <input type="submit" value="Ver Bitácora">
    </form>

    <table style="border:1px solid black;margin-left:auto;margin-right:auto;">
      <tr>
        <th>Nombre del Usuario</th>
        <th>Rut</th>
        <th>Telefono</th>
        <th>Dirección</th>
        <th>Email</th>
        <th>Rol - Cargo</th>
      </tr>
      <tr >
        <td>Maria</td>
        <td>18774558-1</td>
        <td>+56889778454</td>
        <td>Pedro de Valdivia</td>
        <td>maria@gmail.com</td>
        <td>Encargada de Ventas</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>
      <tr>
        <td>Karl</td>
        <td>12990778-K</td>
        <td>+56771235844</td>
        <td>La Granja</td>
        <td>karl@gmail.com</td>
        <td>operador</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>
      <tr>
        <td>Juan Carlos</td>
        <td>20715846-8</td>
        <td>+56991225487</td>
        <td>Estación Central</td>
        <td>juancarlos@gmail.com</td>
        <td>operador</td>
        <th><input type="button" value="Eliminar"></th>
        <th><input type="button" value="Editar"></th>
      </tr>
    </table>
  </body>
</html>
