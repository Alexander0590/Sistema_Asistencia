<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>

<!-- formulario usuario -->
  <div class="container-fluid  mb-4" id="mainContainer">
    <div id="centeredFormWrapper" class="d-flex justify-content-center align-items-center mt-3">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-6 col-lg-8" id="formColumn">
          <div class="card shadow" id="formCard">
            <div class="card-header text-center" id="cardHeader">
            <button type="button" id="btnRetroceder2" class="btn btn-sm btn-outline-secondary float-start" style="display: none;">
            <i class="bi bi-arrow-left "></i> 
            </button>
              <b><i class="bi bi-person-plus"></i> REGISTRO DE USUARIO</b>
            </div>
            <div class="card-body" id="formCardBody">
              <form class="row g-3" id="usuarioform">
                 <!-- Datos  del usuario-->
                 <input type="hidden" id="viejo_dni" name="viejo_dni">
                 <div class="col-md-2" id="nombreUsuarioContainer">
                    <label for="nombreUsuario" class="form-label">
                      <i class="bi bi-file-earmark-binary"></i> Dni
                    </label>
                    <input type="number" class="form-control" id="dniusu" placeholder="Dni" max="99999999" oninput="validarLongitud(this)" required>
                  </div>
                 <div class="col-md-5" id="nombreUsuarioContainer">
                    <label for="nombreUsuario" class="form-label">
                      <i class="bi bi-person-square"></i> Datos
                    </label>
                    <input type="text" class="form-control" id="datosu" placeholder="Datos del usuario" required>
                  </div>

                <div class="col-md-5" id="nombreUsuarioContainer">
                  <label for="nombreUsuario" class="form-label" id="nombreUsuarioLabel">
                    <i class="bi bi-person"></i> Nombre de Usuario
                  </label>
                  <input type="text" class="form-control" id="nomusuario" placeholder="Nombre de usuario" required>
                </div>
       
                  <div class="col-md-6" id="contrasenaContainer">
                    <label for="contrasena" class="form-label" id="contrasenaLabel">
                      <i class="bi bi-lock"></i> Contraseña
                    </label>
                    <input type="password" class="form-control" id="pass" placeholder="Contraseña" required>
                  </div>

                <div class="col-md-6" id="correoContainer">
                  <label for="correo" class="form-label" id="correoLabel">
                    <i class="bi bi-envelope"></i> Correo Electrónico
                  </label>
                  <input type="email" class="form-control" id="correo" placeholder="Correo electrónico" required>
                </div>

                <div class="col-md-6" id="confirmarContrasenaContainer">
                  <label for="confirmarContrasena" class="form-label" >
                    <i class="bi bi-telephone"></i> Telefono
                  </label>
                  <input type="number" class="form-control" id="telef" placeholder="Telefono" required>
                </div>

                <div class="col-md-6" id="fechaContainer">
                  <label for="fecha" class="form-label" id="fechaLabel">
                  <i class="bi bi-person-lines-fill"></i> Rol
                  </label>
                  <select class="form-select" id="rol" required>
                      <option value="">Seleccione</option>
                      <option value="1">Administrador</option>
                      <option value="2">Personal</option>
                    </select>
                </div>

                <div class="col-12 text-center" id="buttonContainer">
                  <button type="submit" class="btn btn-success" id="btreusu">
                    <i class="bi bi-check-circle"></i> Registrar Usuario
                  </button>
                  <button type="button" class="btn btn-warning" id="btacusu" style="display: none;">
                  <i class="bi bi-arrow-clockwise"></i>Actualizar
                  </button>

                  <button type="reset" class="btn btn-secondary" id="btnLimpiar">
                    <i class="bi bi-arrow-repeat"></i> Limpiar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>
</html>
