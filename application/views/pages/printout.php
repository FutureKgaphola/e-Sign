
<?php
require_once BASEPATH . '/helpers/url_helper.php'; 
require('fpdf/fpdf.php');
class PDF extends FPDF
{
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    function Header()
    {
        // Path to your image, x position, y position, and width
        $this->Image('public/assets/images/logo.png', 10, 6, 30); 
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 15, 'Employee Attendance Report', 0, 1, 'C');
        $this->Ln(10); // Add some space after the header
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$maxSizeCellWidth = 184;
$maxSizeCellHeight = 10;
$numCols = 6;
$colWidth = $maxSizeCellWidth / $numCols;

$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell($colWidth+5,$maxSizeCellHeight,"Employee Name",1,0,'L',0);
$pdf->Cell($colWidth+5,$maxSizeCellHeight,"Position",1,0,'L',0);
$pdf->Cell($colWidth,$maxSizeCellHeight,"Employee N0.",1,0,'L',0);
$pdf->Cell($colWidth+5,$maxSizeCellHeight,"Signed In",1,0,'L',0);
$pdf->Cell($colWidth+5,$maxSizeCellHeight,"Signed Out",1,0,'L',0);
$pdf->Cell($colWidth-5,$maxSizeCellHeight,"Employment",1,1,'L',0);

$pdf->SetFont('Arial','',9);
if (isset($records) && count($records) > 0) {
    foreach ($records as $emp){
        $pdf->Cell($colWidth+5,$maxSizeCellHeight,$emp['name'],1,0,'L',0);
        $pdf->Cell($colWidth+5,$maxSizeCellHeight,$emp['position'],1,0,'L',0);
        $pdf->Cell($colWidth,$maxSizeCellHeight,$emp['emp_no'],1,0,'L',0);
        $pdf->Cell($colWidth+5,$maxSizeCellHeight,$emp['signed_in'],1,0,'L',0);
        $pdf->Cell($colWidth+5,$maxSizeCellHeight,$emp['signed_out'],1,0,'L',0);
        $pdf->Cell($colWidth-5,$maxSizeCellHeight,$emp['empStatus'],1,1,'L',0);
        }
}else{
    $pdf->Cell($maxSizeCellWidth+15,$maxSizeCellHeight,"No Records Found",1,0,'C',0);
}
    

$pdf->Output();
?>

