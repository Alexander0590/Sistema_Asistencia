<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body >
<!-- Modal de foto  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #060614; color: #ffffff;">
                <div class="modal-header" style="border-bottom: 1px solid #8773e7;">
                    <h5 class="modal-title" id="exampleModalLabel">Foto </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-bodyper">
                    <img  id="fotoper" src="img/2.png" alt="Imagen" class="img-fluid">
                </div>
                <div class="modal-footer" style="border-top: 1px solid #8773e7;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #8773e7; color: #ffffff;">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------FIN DEL MODAL------------------------------------------------ -->
    <!-- Formulario de personal -->
  <div class="container-fluid  mb-4" id="mainContainer">
    <div id="centeredFormWrapper" class="d-flex justify-content-center align-items-center mt-3">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-6 col-lg-8" id="formColumn">
          <div class="card shadow" id="formCard">
          <div class="card-header text-center" id="cardHeader">
          <button type="button" id="btnRetroceder" class="btn btn-sm btn-outline-secondary float-start" style="display: none;">
            <i class="bi bi-arrow-left "></i> 
          </button>
          <b><i class="bi bi-person-plus"></i> REGISTRO DE PERSONAL</b>
        </div>
            <div class="card-body" id="formCardBody">
              <form class="row g-3" id="personalform">
              <input type="hidden" id="viejo_dni" name="viejo_dni">
              <input type="hidden" id="pfotoBase64" name="pfotoBase64">
                 <div class="col-md-2" >
                    <label for="nombreUsuario" class="form-label">
                    <i class="bi bi-file-earmark-binary"></i> DNI
                    </label>
                    <input type="number" class="form-control" id="pdni" placeholder="DNI"min="0" max="99999999" oninput="validarLongitud(this)"required>
                  </div>

                <div class="col-md-5" >
                  <label for="nombreyapellidos" class="form-label">
                    <i class="bi bi-person"></i> Nombres y Apellidos
                  </label>
                  <input type="text" class="form-control" id="pnombreape" placeholder="Nombres y Apellidos" required>
                </div>
       
                  <div class="col-md-5" >
                    <label for="modalidad" class="form-label" >
                    <i class="bi bi-file-text"></i> Modalidad de Contratacion
                    </label>
                    <select class="form-select"  id="pmodalidad" required>
                      <option value="">Seleccione</option>
                      <option value="1">D.L N°276- Carrera Administrativa</option>
                      <option value="2">D.L N°728- Obrero</option>
                    </select>
                  </div>

                <div class="col-md-5" >
                  <label for="cargo" class="form-label" >
                  <i class="bi bi-briefcase"></i> Cargo
                  </label>
                  <input type="text" class="form-control" id="pcargo" placeholder="Ingresa el Cargo" required>
                </div>

                <div class="col-md-5" >
                  <label for="fecha de nacimiento" class="form-label" >
                  <i class="bi bi-calendar"></i> Fecha de Nacimiento
                  </label>
                  <input type="date" class="form-control" id="pfechanaci" max="2006-12-31" required>
                </div>

                <div class="col-md-2" >
                  <label for="edad" class="form-label" >
                  <i class="bi bi-file-earmark-person"></i> Edad
                  </label>
                  <input type="number" class="form-control" id="pedad"  readonly disabled>
                </div>

                <div class="col-md-3" >
                  <label for="sueldo" class="form-label" >
                  <i class="bi bi-cash"></i> Sueldo
                  </label>
                  <input type="number" class="form-control" id="psuel" placeholder="S/." required>
                </div>

                <div class="col-md-5">
                <label for="foto" class="form-label">
                  <i class="bi bi-camera"></i> Foto
                </label>
                <input type="file" class="form-control" id="pfoto" accept=".jpg, .jpeg" required>
              </div>
                <div class="col-md-4" >
                    <label for="estado" class="form-label" >
                    <i class="bi bi-record-circle"></i> Estado
                    </label>
                    <select class="form-select"  id="pestado" disabled required>
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                  </div>
                
                <div class="col-12 text-center" id="buttonContainer">
                  <button type="submit" class="btn btn-success" id="btreper">
                    <i class="bi bi-check-circle"></i> Registrar Personal
                  </button>
                  <button type="button" class="btn btn-warning" id="btacuper" style="display: none;">
                  <i class="bi bi-arrow-clockwise"></i>Actualizar
                  </button>

                  <button type="reset" class="btn btn-secondary" id="btnLimper">
                    <i class="bi bi-arrow-repeat"></i> Limpiar
                  </button>
                  <button type="button" id="btnfotoper" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
                 <i class="bi bi-eye"></i> ver foto
                  </button>
                </div>
              </form>
            </div>  
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- ---------------------------------------------FIN DEL FORMULARIO ---------------------------- --> 
  <script>
    //para habilitar el boton ver foto cuando se cargue un archivo
    document.getElementById("pfoto").addEventListener("change", function(event) {
  const file = event.target.files[0];
  const btnfoto = document.getElementById("btnfotoper");
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const preview = document.getElementById("fotoper");
      preview.src = e.target.result;
      preview.style.display = "block";
      btnfoto.disabled = false;
      let modal = new bootstrap.Modal(document.getElementById("exampleModal"));
      modal.show();
    };
    reader.readAsDataURL(file);
  }else{
    btnfoto.disabled = true;
  }
});

//----------------------------------------------------------------------//
//funcion para calcular la edad
const fechaInput = document.getElementById('pfechanaci');
const edadInput = document.getElementById('pedad');

const calcularEdad = (fechaNacimiento) => {
  const fechaActual = new Date(); 
  const fechaNac = new Date(fechaNacimiento); 

  // Calcular la diferencia en años
  let edad = fechaActual.getFullYear() - fechaNac.getFullYear();

  const mesActual = fechaActual.getMonth();
  const diaActual = fechaActual.getDate();
  const mesNac = fechaNac.getMonth();
  const diaNac = fechaNac.getDate();

  if (mesActual < mesNac || (mesActual === mesNac && diaActual < diaNac)) {
    edad--; 
  }

  return edad;
};

// Escuchar el evento change en el campo de fecha
fechaInput.addEventListener('change', () => {
  const fechaSeleccionada = fechaInput.value; 

  if (fechaSeleccionada) {
    const edad = calcularEdad(fechaSeleccionada); 
    edadInput.value = edad; 
  } else {
    edadInput.value = ''; 
  }
});
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>
</html>