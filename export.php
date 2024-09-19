<?php
// Include your database configuration file
include 'db.php';
require_once('./export_pdf.php'); 

// Fetch records from the database
$sql = "SELECT * FROM records";
$result = $conn->query($sql);

// Define CSV file path
$csvFilePath = 'records.csv';

// Open the CSV file for writing
$file = fopen($csvFilePath, 'w');

// Write header row
fputcsv($file, array('ID', 'Name', 'Email'));

// Write records to CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($file, $row);
}

// Close the file
fclose($file);

// Prompt download for the generated CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . basename($csvFilePath) . '"');
header('Content-Length: ' . filesize($csvFilePath));
readfile($csvFilePath);

// Delete the temporary CSV file
unlink($csvFilePath);

// Close database connection
$conn->close();
exit;
?>
