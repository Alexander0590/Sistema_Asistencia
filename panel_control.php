<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php?dato=" . urlencode("Debe iniciar sesión para acceder."));
    exit();
}
if($_SESSION['rol']==="1"){
  $rol="Administrador";
}else{
  $rol="Personal";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Panel</title>
    <script src="javascrip/jquery-3.7.1.min.js"></script> 
   <link rel="stylesheet" href="estilos/estilos_panel.css">
   <link rel="stylesheet" href="estilos/estilosdeviews.css">
   <link rel="shortcut icon" href="img/Logo_Tecnología_Geek_Ilustrado_Verde_y_Azul-removebg-preview.png" type="image/x-icon">
</head>
<body class="animate__animated animate__fadeIn">
  
<!-- Menu de nacegacion horizontal -->
<div class="container-tp" id="bhoriz">
        <div class="perfil" data-bs-toggle="modal" data-bs-target="#perfilModal">
            <div id="foto">
                <img src="img/2.png" alt="Foto de perfil">
            </div>
            <div id="nombre">
                <h5>
                    <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                    <i class="bi bi-caret-down-square-fill"></i>
                </h5>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #060614; color: #ffffff;">
      <div class="modal-header" style="border-bottom: 1px solid #8773e7;">
        <h5 class="modal-title" id="perfilModalLabel"><b>Información del perfil</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body ">
        <div id="foto-modal " class="text-center mb-3">
          <img src="img/2.png" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 150px; height: 150px; margin-bottom: 10px ;">
        </div>
        <div text-fill>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($_SESSION['tel']); ?></p>
        <p><strong>Rol:</strong> <?php echo $rol; ?> </p>
        </div>
     
      </div>
        <div class="modal-footer" style="border-top: 1px solid #8773e7;">
       <a href="proceso/cerrar_sesion.php" class="btn btn-secondary" style="background-color: #8773e7; color: #ffffff;">
          <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
      </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #8773e7; color: #ffffff;">
          <i class="bi bi-x-circle"></i> Cerrar
        </button>
        <button type="button" class="btn" style="background-color: #8773e7; color: #ffffff;">
          <i class="bi bi-pencil-square"></i> Editar Información
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Menu Navegacion Vertical -->
<div class="sidebar v-a" id="mySidebar">
    <i class="bi bi-list menu-btn" onclick="toggleSidebar()" id="xd"></i>
    <a href="#" id="inicio"><i class="bi bi-house-door"></i><span>Inicio</span></a>
    <a href="#"><i class="bi bi-bar-chart-line"></i><span>Dashboard</span></a>
    <div class="menu-item">
        <a href="#"><i class="bi bi-calendar-check"></i><span>Asistencia</span></a>
        <div class="submenu">
            <a href="#" id="x2">Registrar asistencia</a>
            <a href="#" id="x3">Ver asistencia</a>
            <a href="#">Reportes de asistencia</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#" ><i class="bi bi-people"></i><span>Personal</span></a>
        <div class="submenu">
            <a href="#" id="liper">Lista de personal</a>
            <a href="#" id="x4">Agregar personal</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#"><i class="bi bi-calendar-event"></i><span>Eventos</span></a>
        <div class="submenu">
            <a href="#">Ver eventos</a>
            <a href="#">Agregar evento</a>
            <a href="#">Reportes de eventos</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#"><i class="bi bi-person-circle"></i><span>Usuarios</span></a>
        <div class="submenu">
            <a href="#" id="lisusu">Ver usuarios</a>
            <a href="#" id="usuario">Agregar usuario</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#"><i class="bi bi-gear"></i><span>Configuraciones</span></a>
        <div class="submenu">
            <a href="#">Configurar lector</a>
            <a href="#">Parámetros de asistencia</a>
        </div>
    </div>
    <div class="menu-item">
        <a href="#"><i class="bi bi-graph-up"></i><span>Reportes</span></a>
        <div class="submenu">
            <a href="#">Resumen mensual</a>
            <a href="#">Asistencia por empleado</a>
        </div>
    </div>
    <a href="proceso/cerrar_sesion.php"><i class="bi bi-box-arrow-left"></i><span>Cerrar Sesión</span></a>
</div>

<div id="vistas">
 <img id="imgdeinicio"  src="img/muni.png" alt="">
</div>


<script src="javascrip/panel.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="javascrip/usuariosmante.js"></script>
<script src="javascrip/personalmante.js"></script>
</body>
</html>

