const sidebar = document.getElementById('mySidebar');


//expander la barra horizontal
sidebar.addEventListener('mouseover', function() {
    sidebar.classList.add('expanded');
});
//constraer la barra horizontal
sidebar.addEventListener('mouseout', function() {
    sidebar.classList.remove('expanded');
});

//formulario personal validar dni
function validarLongitud(input) {
  let valor = input.value.toString().replace(/\D/g, '');


  if (valor.length > 8) {
      valor = valor.slice(0, 8);
  }
  input.value = valor;
}


//traer las vistas con jquery
$(document).ready(function () {
  $("#inicio").click(function (e) {
    e.preventDefault(); 
    location.reload(); 
  });
  
    // Usuarios
    $("#usuario").click(function (e) {
      e.preventDefault(); 
      $("#vistas").load("view/usuario.php"); 
    });
    //listado de usuarios
    $("#lisusu").click(function (e) {
      e.preventDefault(); 
      $("#vistas").load("view/listadeusuarios.php"); 
    });
    //lista de personal
    $("#liper").click(function (e) {
      e.preventDefault(); 
      $("#vistas").load("view/listadepersonal.php"); 
    });
    //trabajadores
    $("#x4").click(function (e) {
      e.preventDefault(); 
      $("#vistas").load("view/personal.php"); 
    });
    //Asistencia
    $("#x2").click(function (e) {
      e.preventDefault(); 
      $("#vistas").load("view/asistencia.html"); 
    });
  });


 