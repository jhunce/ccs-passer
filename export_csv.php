<?php
// Function to read CSV file
function readCSV($filename) {
    $data = [];
    if (file_exists($filename)) {
        $handle = fopen($filename, 'r');
        if ($handle !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
    }
    return $data;
}

// Read applicants data
$applicants = readCSV('data/applicants.csv');

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="applicants_' . date('Y-m-d_H-i-s') . '.csv"');
header('Pragma: no-cache');
header('Expires: 0');

// Create output stream
$output = fopen('php://output', 'w');

// Write CSV data
foreach ($applicants as $row) {
    fputcsv($output, $row);
}

fclose($output);
?> 