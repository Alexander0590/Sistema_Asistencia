<?php
 include('../conecxion/conecxion.php');

 $action = $_GET['action'] ?? '';

 switch ($action) {
     case 'create':
         // Crear un nuevo personal
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = $_POST['dni'];
            $nombres = $_POST['nombres'];
            $modalidad = $_POST['modalidad'];
            $cargo = $_POST['cargo'];
            $fechanaci = $_POST['fechanaci'];
            $edad = $_POST['edad'];
            $sueldo = $_POST['sueldo'];
            $foto64 = $_POST['foto'];
            $modalidad_texto = ($modalidad == 1) ? "D.L N°276 - Carrera Administrativa" : "D.L N°728 - Obrero";
             // busqueda de dni 
             $bus_query = "SELECT iddni FROM personal WHERE iddni = '$dni'";
             $result = mysqli_query($cnn, $bus_query);
 
             if (mysqli_num_rows($result) > 0) {
                 echo json_encode(["status" => "error", "message" => "El DNI ya está registrado"]);
             } else {
                 $query = "INSERT INTO personal (iddni, nombres_apellidos, modalidad_contratacion, cargo, fecha_nacimiento, edad, sueldo, fecha_registro, foto) 
                           VALUES ('$dni', '$nombres', '$modalidad_texto', '$cargo', '$fechanaci', $edad, $sueldo, NOW(), '$foto64')";
                 if (mysqli_query($cnn, $query)) {
                     echo json_encode(["status" => "success"]);
                 } else {
                     echo json_encode(["status" => "error", "message" => mysqli_error($cnn)]);
                 }
             }
         }
         break;

         case 'read':
            // Leer todos los usuarios
            $query = "SELECT * FROM personal";
            $result = mysqli_query($cnn, $query);
            
            $personal = [];
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $personal[] = $row;
                }
            }
            echo json_encode($personal);
            break;
            
     case 'update':
         // Actualizar un usuario
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $dni = $_POST['dni'];
             $nombres = $_POST['nombres'];
             $modalidad = $_POST['modalidad'];
             $cargo = $_POST['cargo'];
             $fechanaci = $_POST['fecha_nacimiento'];
             $edad = $_POST['edad'];
             $sueldo = $_POST['sueldo'];
             $foto = $_POST['foto'];
             $estado= $_POST['estado'];
            
             if($modalidad=="1"){
               $modalidad1="D.L N°276 - Carrera Administrativa";
             }else{
                $modalidad1="D.L N°728 - Obrero";
             }
             if($estado == "1"){
                $estado1="activo";
             }else{
                $estado1="inactivo";
             }
             $query = "UPDATE personal SET  iddni= $dni , nombres_apellidos = '$nombres', modalidad_contratacion = '$modalidad1', cargo = '$cargo', fecha_nacimiento= '$fechanaci' ,edad = $edad ,sueldo= $sueldo ,foto = '$foto' ,estado = '$estado1'
              WHERE iddni = $dni";
             if (mysqli_query($cnn, $query)) {
                 echo json_encode(["status" => "success"]);
             } else {
                 echo json_encode(["status" => "error", "message" => mysqli_error($cnn)]);
             }
         }
         break;


     case 'readOne':
     //traer usuario 
        $id = $_GET['id'];
        $sql = "SELECT * FROM personal WHERE iddni = $id";
        $result = mysqli_query($cnn, $sql);
 
        if ($result && mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado.']);
        }
            
        break;

     case 'delete':
         // Eliminar un usuario
         $id = $_GET['id'];
         echo $id;
         $query = "DELETE FROM personal WHERE iddni = $id";
         if (mysqli_query($cnn, $query)) {
             echo json_encode(["status" => "success"]);
         } else {
             echo json_encode(["status" => "error", "message" => mysqli_error($cnn)]);
         }
         break;
 
     default:
         echo json_encode(["status" => "error", "message" => "Acción no válida"]);
 }
?>