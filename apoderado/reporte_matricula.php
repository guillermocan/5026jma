<?php
session_start();
require_once '../config/db.php';
require_once '../libs/fpdf.php'; // Asegúrate de tener la librería en esta ruta

if (!isset($_SESSION['ID_Apoderado']) || !isset($_GET['id'])) {
    die("Acceso no autorizado");
}

$id_matricula = $_GET['id'];
$id_apoderado = $_SESSION['ID_Apoderado'];

// Consulta completa uniendo las 3 tablas
$sql = "SELECT m.Estado_tramite, m.Fecha_registro, m.Ano_Escolar,
               e.Nombres AS nom_est, e.ApellidoP AS apeP_est, e.ApellidoM AS apeM_est, e.DNI, e.Nivel, e.Grado,
               u.Nombres AS nom_apo, u.Apellidos AS ape_apo, a.Telefono, a.Direccion
        FROM Matricula m
        INNER JOIN Estudiante e ON m.ID_Estudiante = e.ID_Estudiante
        INNER JOIN Apoderado a ON m.ID_Apoderado = a.ID_Apoderado
        INNER JOIN Usuario u ON a.ID_Usuario = u.ID_Usuario
        WHERE m.ID_Matricula = ? AND m.ID_Apoderado = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_matricula, $id_apoderado]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) die("No se encontró la información.");

// --- GENERACIÓN DEL PDF ---
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, utf8_decode('I.E. 5026 JOSÉ MARÍA ARGUEDAS'), 0, 1, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, utf8_decode('CONSTANCIA DE REGISTRO DE MATRÍCULA'), 0, 1, 'C');
        $this->Ln(5);
        $this->Line(10, 32, 200, 32);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Datos de la Matrícula
$pdf->SetFillColor(230, 230, 230);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('DATOS DEL PROCESO'), 1, 1, 'L', true);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(95, 8, utf8_decode('Año Escolar: ').$data['Ano_Escolar'], 1);
$pdf->Cell(95, 8, utf8_decode('Fecha de Registro: ').date('d/m/Y', strtotime($data['Fecha_registro'])), 1, 1);
$pdf->Cell(0, 8, utf8_decode('Estado Actual: ').strtoupper($data['Estado_tramite']), 1, 1);
$pdf->Ln(5);

// Datos del Estudiante
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('DATOS DEL ESTUDIANTE'), 1, 1, 'L', true);
$pdf->SetFont('Arial', '', 11);
$fullEst = $data['apeP_est']." ".$data['apeM_est'].", ".$data['nom_est'];
$pdf->Cell(0, 8, utf8_decode('Apellidos y Nombres: ').utf8_decode($fullEst), 1, 1);
$pdf->Cell(60, 8, utf8_decode('DNI: ').$data['DNI'], 1);
$pdf->Cell(60, 8, utf8_decode('Nivel: ').$data['Nivel'], 1);
$pdf->Cell(70, 8, utf8_decode('Grado: ').$data['Grado'].utf8_decode('°'), 1, 1);
$pdf->Ln(5);

// Datos del Apoderado
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('DATOS DEL APODERADO'), 1, 1, 'L', true);
$pdf->SetFont('Arial', '', 11);
$fullApo = $data['ape_apo'].", ".$data['nom_apo'];
$pdf->Cell(0, 8, utf8_decode('Apellidos y Nombres: ').utf8_decode($fullApo), 1, 1);
$pdf->Cell(60, 8, utf8_decode('Teléfono: ').$data['Telefono'], 1);
$pdf->Cell(130, 8, utf8_decode('Dirección: ').utf8_decode($data['Direccion']), 1, 1);

$pdf->Ln(20);
$pdf->SetFont('Arial', 'I', 9);
$pdf->MultiCell(0, 5, utf8_decode('Nota: Este documento es una constancia de trámite realizado vía sistema. Su validez está sujeta a la revisión y aprobación de los datos presentados por parte de la secretaría de la institución.'), 0, 'C');

$pdf->Output('I', 'Reporte_Matricula_'.$data['DNI'].'.pdf');