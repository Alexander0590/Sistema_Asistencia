<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Corporativo</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="estilos/estilosindex.css">
  <link rel="shortcut icon" href="img/logo_respaldo1.ico" type="image/x-icon">

</head>
<body>
  <div class="login-container">
    <img src="img/muni.png" id="x1" alt="Logo de la Empresa">
    <h3>Acceso Corporativo</h3>
    <form action="proceso/login.php" method="post">
      <div class="form-group position-relative">
        <i class="bi bi-person-fill"></i>
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
      </div>
      <div class="form-group position-relative">
      
        <i class="bi bi-lock-fill"></i>
        <input type="password" class="form-control" placeholder="Contraseña" name="clave" required>
      </div>
      <button type="submit" class="btn btn-custom btn-block"><span id="ingre">Ingresar</span></button>
      <?php
      $dato = isset($_GET['dato']) ? $_GET['dato'] : '';
      if (!empty($dato)) {
          echo "<spam>$dato</spam>"; 
      } else {
          echo "<spam> </spam>";
      }
    ?>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
