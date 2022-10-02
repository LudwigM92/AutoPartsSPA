<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['nombre']) && !empty($_POST['rut']) && !empty($_POST['telefono']) && !empty($_POST['direccion']) && !empty($_POST['email'])) {
    
    $email = $_POST['email'];
    $rut = $_POST['rut'];
    $sql = "SELECT rut FROM clientes WHERE rut= :rut";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':rut',$rut, PDO::PARAM_STR);
    $sth->execute();

    if ($sth->rowCount() > 0) {
      $message = "Rut ya existe";
    } else {
      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO clientes (nombre, rut, telefono, direccion, email) VALUES (:nombre, :rut , :telefono, :direccion, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rut', $_POST['rut']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':email', $_POST['email']);
        
        if ($stmt->execute()) {
          $message = 'Cuenta creada exitosamente';
        }else {
          $message = 'Hay un inconveniente';
        }
      }else{        
        $message = "Email inválido"."<br>";
      }
    }

    
    }else{
      $message = 'Debes completar todas las casillas';
    } 
    
    

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrar Cliente</h1>
    <span><a href="buscarCliente.php">Buscar Cliente</a></span>  <br>
    <span><a href="bitacora_usuarios.php">Bitácora de Usuarios</a></span>  <br>

    <form action="crearCliente.php" method="POST">
      <input name="nombre" type="text" placeholder="Ingresa nombre del cliente">
      <input name="rut" type="text" placeholder="Ingresa Rut del cliente">
      <input name="telefono" type="text" placeholder="Ingresa telefono del cliente">
      <input name="direccion" type="text" placeholder="Ingresa dirección del cliente">
      <input name="email" type="text" placeholder="Ingresa email del cliente">
      <input type="submit" value="Registrar Cliente">
    </form>

  </body>
</html>
