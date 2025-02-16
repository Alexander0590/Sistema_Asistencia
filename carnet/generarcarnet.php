<?php
require 'vendor/autoload.php';
include('../conecxion/conecxion.php');

$idpersonal = $_GET['id']; 

// Consultar la base de datos para obtener los datos del personal
$query = "SELECT iddni , nombres_apellidos,cargo,foto FROM personal WHERE iddni = ?";
$stmt = $cnn->prepare($query);
$stmt->bind_param("i", $idpersonal); // "i" indica que el parámetro es un entero
$stmt->execute();
$result = $stmt->get_result();
$personal = $result->fetch_assoc();


if ($personal) {
    // Extraer los datos del personal
    $nombre = $personal['nombres_apellidos'];
    $codigo = $personal['iddni'];
    $cargo = $personal['cargo'];
    $foto64 = $personal['foto']; 
     
  if (strpos($foto64, 'data:image/jpeg;base64,') === 0) {
    $foto64 = str_replace('data:image/jpeg;base64,', '', $foto64);
}

$fotoBinaria = base64_decode($foto64);
if ($fotoBinaria === false) {
    die("Error al decodificar la imagen Base64.");
}

$rutaFoto = 'temp_foto_personal.jpg'; 
file_put_contents($rutaFoto, $fotoBinaria);
$logoEmpresa = '../img/muni.png';

    // Crear el PDF con tamaño ajustado al carnet
    $pdf = new TCPDF('L', 'mm', array(85, 55), true, 'UTF-8', false);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->AddPage();

    // Fondo del carnet
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Rect(0, 0, 85, 58, 'F');
    $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
    $pdf->RoundedRect(2, 2, 81, 51, 3, '1111', 'D');

    // Añadir la foto
    $pdf->Image($rutaFoto, 5, 10, 25, 35, 'JPG', '', '', false, 300, '', false, false, 0);

    // Título del carnet
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetTextColor(0, 51, 102);
    $pdf->SetXY(35, 5);
    $pdf->Cell(45, 10, 'CARNET DE ASISTENCIA', 0, 1, 'C', 0);

    // Código del personal
    $pdf->SetXY(35, 26);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(45, 5, 'Dni: ' . $codigo, 0, 0, 'L');

    // Configuración para nombre
    $pdf->SetXY(35, 16);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(45, 5, 'Nombre: ' . $nombre, 0, 'L', 0, 1);



    // cargo dinámico
    $pdf->SetXY(35, 32);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(45, 5, 'Cargo: ' . $cargo, 0, 'L', 0, 1);

    // Código de barras
    $barcodeStyle = array(
        'border' => 0,
        'padding' => 1,
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => array(255, 255, 255),
    );
    $pdf->write1DBarcode($codigo, 'C128', 38, 41, 50, 8, 0.4, $barcodeStyle, 'N');
    $pdf->AddPage(); 

    // Establecer fondo blanco
    $pdf->SetFillColor(255, 255, 255); 
    $pdf->Rect(0, 0, 85, 55, 'F'); 

    // Añadir el logo de la empresa en el centro
    $pdf->Image($logoEmpresa, 25, 12, 35, 35, '', '', '', true);
    // Limpiar la imagen temporal
    unlink($rutaFoto);

    // Exportar el PDF
    $filename = 'carnet_' . $codigo . '.pdf';
    $pdf->Output($filename, 'D'); 
    exit;
} else {
    die("personal no encontrado.");
}
?>
