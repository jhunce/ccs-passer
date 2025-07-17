<?php
// Start session to store results
session_start();

// Function to read CSV file
function readCSV($filename) {
    $data = [];
    if (file_exists($filename)) {
        $handle = fopen($filename, 'r');
        if ($handle !== false) {
            // Skip header row
            fgetcsv($handle);
            
            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) >= 2) {
                    $data[] = [
                        'name' => trim($row[0]),
                        'result' => trim($row[1])
                    ];
                }
            }
            fclose($handle);
        }
    }
    return $data;
}

// Function to search for applicant
function searchApplicant($fullName, $applicants) {
    $fullName = strtolower(trim($fullName));
    
    foreach ($applicants as $applicant) {
        if (strtolower($applicant['name']) === $fullName) {
            return $applicant;
        }
    }
    return null;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    
    if (empty($fullName)) {
        header('Location: index.php?message=Please enter your full name.');
        exit;
    }
    
    // Read applicants from CSV
    $applicants = readCSV('data/applicants.csv');
    
    // Search for the applicant
    $applicant = searchApplicant($fullName, $applicants);
    
    if ($applicant) {
        // Store result in session
        $_SESSION['screening_result'] = [
            'name' => $applicant['name'],
            'result' => $applicant['result']
        ];
        
        // Redirect to result page
        header('Location: result.php');
        exit;
    } else {
        // Applicant not found
        header('Location: index.php?message=No results found for this name. Please check your spelling and try again.');
        exit;
    }
} else {
    // If accessed directly without POST, redirect to home
    header('Location: index.php');
    exit;
}
?>