<?php
echo "<h1>PHP Server Test</h1>";
echo "<p>PHP is working! Current time: " . date('Y-m-d H:i:s') . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// Test file permissions
$dataDir = 'data/';
$csvFile = 'data/applicants.csv';

echo "<h2>File System Test</h2>";
echo "<p>Data directory exists: " . (is_dir($dataDir) ? 'YES' : 'NO') . "</p>";
echo "<p>CSV file exists: " . (file_exists($csvFile) ? 'YES' : 'NO') . "</p>";
echo "<p>CSV file readable: " . (is_readable($csvFile) ? 'YES' : 'NO') . "</p>";

// Test CSV reading
if (file_exists($csvFile)) {
    echo "<h2>CSV Content Test</h2>";
    $handle = fopen($csvFile, 'r');
    if ($handle) {
        echo "<p>CSV file opened successfully</p>";
        $row = fgetcsv($handle);
        echo "<p>Header row: " . implode(', ', $row) . "</p>";
        fclose($handle);
    } else {
        echo "<p>Error opening CSV file</p>";
    }
}
?> 