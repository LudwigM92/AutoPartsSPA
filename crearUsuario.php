<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['nombre']) && !empty($_POST['rut']) && !empty($_POST['telefono']) && !empty($_POST['direccion']) 
  && !empty($_POST['email']) && !empty($_POST['rol'])) {
    
    $sql = "INSERT INTO usuarios (nombre, rut, telefono, direccion, email, rol) VALUES (:nombre, :rut , :telefono, :direccion, :email, :rol)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rut', $_POST['rut']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':rol', $_POST['rol']);
        
        if ($stmt->execute()) {
          $message = 'Cuenta creada exitosamente';
        }else {
          $message = 'Hay un inconveniente';
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

    <h1>Registrar o Editar Usuario</h1>
    <span><a href="buscarCliente.php">Buscar Cliente</a></span>  <br>
    <span><a href="bitacora_usuarios.php">Bitácora de Usuarios</a></span>  <br>

    <form action="crearUsuario.php" method="POST">
      <input name="nombre" type="text" placeholder="Ingresa nombre del usuario">
      <input name="rut" type="text" placeholder="Ingresa Rut del usuario">
      <input name="telefono" type="text" placeholder="Ingresa telefono del usuario">
      <input name="direccion" type="text" placeholder="Ingresa dirección del usuario">
      <input name="email" type="text" placeholder="Ingresa email del usuario">
      <input name="rol" type="text" placeholder="Ingresa Rol o Cargo del usuario">
      <input type="submit" value="Validar Usuario">
    </form>

  </body>
</html>
