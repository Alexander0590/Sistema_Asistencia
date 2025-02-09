//Personal
    //registrar un personal 
    $(document).on('click', '#btreper', function (e) {
        e.preventDefault();

        let dni = $('#pdni').val();
        let nombres = $('#pnombreape').val();
        let modalidad = $('#pmodalidad').val();
        let cargo = $('#pcargo').val();
        let fechanaci = $('#pfechanaci').val();
        let edad = $('#pedad').val();
        let sueldo = $('#psuel').val();
        let fotoInput = $('#pfoto')[0]; 
    
        if (!dni || !nombres || !modalidad || !cargo || !fechanaci || !edad || !sueldo || !fotoInput.files[0]) {
            Swal.fire({
                title: "¡Error!",
                text: "Por favor, completa todos los campos del formulario y selecciona una foto.",
                icon: "error",
                confirmButtonText: "OK"
            }).then(() => {
                $('#personalform')[0].reset();  
            });
            return; 
        }

        let fotoFile = fotoInput.files[0]; 
        let reader = new FileReader(); 
    
        reader.onload = function (event) {
            let fotoBase64 = event.target.result; 
            let datos = {
                dni: dni,
                nombres: nombres,
                modalidad: modalidad,
                cargo: cargo,
                fechanaci: fechanaci,
                edad: edad,
                sueldo: sueldo,
                foto: fotoBase64,
            };
            $.ajax({
                url: 'proceso/mantenpersonal.php?action=create', 
                type: 'POST',
                data: datos, 
                dataType: 'json', 
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "¡Registro exitoso!",
                            text: "Tu registro ha sido creado correctamente.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $('#personalform')[0].reset();  
                        });
                        
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function (error) {
                    console.error('Error en la solicitud AJAX:', error);
                   
                }
            });
        };
        reader.readAsDataURL(fotoFile);
    });


//elinminar personal
$(document).off('click', '.perEliminar').on('click', '.perEliminar', function (event) {
    event.preventDefault();
    let id = $(this).data('id');
    
    $.ajax({
        url: 'proceso/mantenpersonal.php?action=delete&id=' + id,
        type: 'GET',
        success: function () {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás revertir esta acción.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "No, cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "Tu registro ha sido eliminado correctamente.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        $("#vistas").fadeOut(200, function () {
                            $(this).load("view/listadepersonal.php", function () {
                                $(this).fadeIn(200);
                            });
                        });
                    });
                }
            });
            
        },
        error: function (error) {
            console.error('Error al eliminar usuario:', error);
            alert('Error al eliminar usuario. Por favor, inténtalo de nuevo.');
        }
    });
});

//traer datos al formulario personal
$(document).on('click', '.perEditar', function () {
    let id = $(this).data('id'); 
    $("#vistas").fadeOut(200, function () {
        $(this).load("view/personal.php", function () {
            $(this).fadeIn(200); 
            $.ajax({
                url: 'proceso/mantenpersonal.php?action=readOne', 
                type: 'GET',
                data: { id: id },
                dataType: 'json',
                success: function (data) {
                    if ($('#personalform').length) {
                        $('#pdni').val(data.iddni); 
                        $('#pnombreape').val(data.nombres_apellidos);

                        let modalidadnu;
                        if (data.modalidad_contratacion === "D.L N°276 - Carrera Administrativa") {
                            modalidadnu = 1;
                        } else if (data.modalidad_contratacion === "D.L N°728 - Obrero") {
                            modalidadnu = 2;
                        }
                        $('#pmodalidad').val(modalidadnu);
                        let estado;
                        if (data.estado === "activo") {
                            estado = 1;
                        } else if (data.estado === "inactivo") {
                            estado = 2;
                        }

                        $('#pestado').val(estado);

                        if ($('#pestado').prop('disabled')) {
                            $('#pestado').prop('disabled', false);
                        }

                        $('#btreper').hide();  
                        $('#btnLimper').hide();  
                        $('#btacuper').show();
                        $('#pcargo').val(data.cargo); 
                        $('#pfechanaci').val(data.fecha_nacimiento); 
                        $('#pedad').val(data.edad); 
                        $('#psuel').val(data.sueldo); 
                        if (data.foto) {
                            $('#pfotoBase64').val(data.foto);
                            $('#fotoper').attr('src',  data.foto); 
                            $('#btnfotoper').prop('disabled', false);
                            
                        } 
                    } else {
                        console.error("No se encontró el formulario ");
                    }
                },
                error: function (error) {
                    console.error('Error al obtener los datos del usuario:', error);
                }
            });
        });
    });
});


// ACTUALIZAR PERSONAL
$(document).on('click', '#btacuper', function () { 
    let dni = $('#pdni').val();
    let nombres = $('#pnombreape').val();
    let modalidad = $('#pmodalidad').val();
    let cargo = $('#pcargo').val();
    let fecha_nacimiento = $('#pfechanaci').val();
    let edad = $('#pedad').val();
    let sueldo = $('#psuel').val();
    let estado = $('#pestado').val();

    let fotoInput = $('#pfoto')[0]; 
    let foto;
    
    if (fotoInput.files.length > 0) {
        let archivo = fotoInput.files[0]; 
        let lector = new FileReader(); 
    
        lector.onload = function(event) {
            foto = event.target.result.split(',')[1];  
            
        };
    
        lector.readAsDataURL(archivo); 
    } else {
        foto = $('#pfotoBase64').val();
        console.log(foto); 
    }
    

    $.ajax({
        url: 'proceso/mantenpersonal.php?action=update',
        type: 'POST',
        data: {
            dni: dni,
            nombres: nombres,
            modalidad: modalidad,
            cargo: cargo,
            fecha_nacimiento: fecha_nacimiento,
            edad: edad,
            sueldo: sueldo,
            foto : foto,
            estado : estado
        },
        success: function () {
            alert('Usuario actualizado correctamente');


            $('#personalform')[0].reset();
            $('#btreper').show();  
            $('#btacuper').hide();


            $("#vistas").fadeOut(200, function () {
                $(this).load("view/listadepersonal.php", function () {
                    $(this).fadeIn(200);
                });
            });
        },
        error: function (error) {
            console.error('Error al actualizar usuario:', error);
        }
    });
});
//imprimir el carnet
$(document).on('click', '.perImpri', function () {
    let id = $(this).data('id'); 
    $.ajax({
        url: 'carnet/generarcarnet.php', 
        type: 'GET',
        data: { id: id}, 
        xhrFields: {
            responseType: 'blob' 
        },
        success: function (response) {
           
            let blob = new Blob([response], { type: 'application/pdf' });
            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'carnet_' + id + '.pdf'; 
            link.click();
        },
        error: function (error) {
            console.error("Error al generar el carnet:", error);
        }
    });
});
    