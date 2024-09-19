<?php
// Include your database configuration file
include 'db.php';

// Include TCPDF library


// Fetch records from the database
$sql = "SELECT * FROM records";
$result = $conn->query($sql);

// Define PDF file path
$pdfFilePath = 'records.pdf';

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Application Name');
$pdf->SetTitle('Records Export');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Header row
$header = array('ID', 'Name', 'Email');

// Data array
$data = array();

// Fetch records and populate data array
while ($row = $result->fetch_assoc()) {
    $data[] = array($row['id'], $row['name'], $row['email']);
}

// Table
$pdf->WriteHTML('<h2>Records Export</h2>');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('', 'B');
$pdf->WriteHTMLCell(0, 10, '', '', 'Records Table', 0, 1, 0, true, 'C', true);
$pdf->SetFont('');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->WriteHTMLCell(0, 0, '', '', $pdf->Table($header, $data), 0, 1, 0, true, 'C', true);

// Close and output PDF document
$pdf->Output($pdfFilePath, 'F');

// Prompt download for the generated PDF file
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($pdfFilePath) . '"');
header('Content-Length: ' . filesize($pdfFilePath));
readfile($pdfFilePath);

// Delete the temporary PDF file
unlink($pdfFilePath);

// Close database connection
$conn->close();
exit;
?>
