<?php
require_once 'FPDF/fpdf.php';
require_once 'db.php';
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM data ORDER BY dise_code ASC";
$result = mysqli_query($connect, $query);
$sr = 1;
class PDF extends FPDF
{
    // Header function to display table heading
    function Header()
    {
        // Add your table heading here
        $this->SetFont('Times', 'B', 36);
        $this->Cell(400, 20, 'All Data', 0, 1, 'C');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(10, 10, 'Sr', 1, 0, 'C');
        $this->Cell(25, 10, 'Dise code', 1, 0, 'C');
        $this->Cell(35, 10, 'District', 1, 0, 'C');
        $this->Cell(35, 10, 'Block', 1, 0, 'C');
        $this->Cell(15, 10, 'Village', 1, 0, 'C');
        $this->Cell(30, 10, 'School', 1, 0, 'C');
        $this->Cell(55, 10, 'Serial Number', 1, 0, 'C');
        $this->Cell(30, 10, 'Comp Number', 1, 0, 'C');
        $this->Cell(25, 10, 'TFT Serial', 1, 0, 'C');
        $this->Cell(30, 10, 'WEB Serial', 1, 0, 'C');
        $this->Cell(35, 10, 'HEAD Serial', 1, 0, 'C');
        $this->Cell(35, 10, 'SWITCH Serial', 1, 0, 'C');
        $this->Cell(10, 10, 'Lab', 1, 0, 'C');
        $this->Cell(30, 10, 'Register Date', 1, 1, 'C');
    }
}
if (isset($_POST['btnPDF'])) {
    $pdf = new PDF('p', 'mm', 'a3');
    $pdf->AddPage('L');
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 10, $sr, 1, 0, 'C');
        $pdf->Cell(25, 10, $row['dise_code'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['district'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['block'], 1, 0, 'C');
        $pdf->Cell(15, 10, $row['village'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['school'], 1, 0, 'C');
        $pdf->Cell(55, 10, $row['serial_number'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['comp_number'], 1, 0, 'C');
        $pdf->Cell(25, 10, $row['TFT_serial'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['WEB_serial'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['Head_serial'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['Switch_serial'], 1, 0, 'C');
        $pdf->Cell(10, 10, $row['lab'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['regDate'], 1, 1, 'C');
        $sr++;
    }
    $pdf->Output('D', 'Data.pdf');
}

?>