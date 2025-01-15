<?php
require './../vendor/autoload.php';
require('./../models/usuario.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_users'])) {
    $selectedUsers = $_POST['selected_users'];

    // Consulta a la base de datos para obtener los usuarios seleccionados
    $userIds = implode(',', array_map('intval', $selectedUsers));
    $result = Usuario::generarReporteUsuario($userIds);

    // Crear el archivo Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Reporte de Usuarios');

    // Encabezados
    $headers = ['ID Proveedor', 'Nombre', 'Servicio', 'Categorias', 'Teléfono', 'Email', 'Fecha Alta', 'Rol'];
    $sheet->fromArray($headers, null, 'A1');

    // Aplicar estilo en negrita a los encabezados
    $headerStyle = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

    // Datos
    $row = 2;
    while ($user = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue("A$row", $user['idUsuario']);
        $sheet->setCellValue("B$row", $user['user_nombre']);        
        $sheet->setCellValue("C$row", $user['servicio_nombre'] ?? 'No tiene');
        $sheet->setCellValue("D$row", $user['categorias'] ?? 'No tiene');
        $sheet->setCellValue("E$row", $user['user_telefono']);
        $sheet->setCellValue("F$row", $user['user_email']);
        $sheet->setCellValue("G$row", $user['fec_alta']);
        $sheet->setCellValue("H$row", $user['rol']);
        $row++;
    }

    // Aplicar alineación a la izquierda a todas las columnas de datos
    $dataStyle = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $sheet->getStyle("A2:H$row")->applyFromArray($dataStyle);

    // Ajustar automáticamente el ancho de las columnas
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Descargar el archivo Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte_usuarios.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "No se seleccionaron usuarios.";
}
