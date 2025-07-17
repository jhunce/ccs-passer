<?php
session_start();
// Redirect to login if not logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

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

// Function to write CSV file
function writeCSV($filename, $data) {
    $handle = fopen($filename, 'w');
    if ($handle !== false) {
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
        return true;
    }
    return false;
}

// Process form submissions
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_applicant':
                $name = trim($_POST['name']);
                $result = trim($_POST['result']);
                
                if (!empty($name) && !empty($result)) {
                    $applicants = readCSV('data/applicants.csv');
                    if (empty($applicants)) {
                        $applicants = [['Name', 'Result']];
                    }
                    $applicants[] = [$name, $result];
                    
                    if (writeCSV('data/applicants.csv', $applicants)) {
                        $message = 'Applicant added successfully!';
                        $messageType = 'success';
                    } else {
                        $message = 'Error adding applicant.';
                        $messageType = 'danger';
                    }
                } else {
                    $message = 'Please fill in all fields.';
                    $messageType = 'danger';
                }
                break;
                
            case 'import_csv':
                if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
                    $uploadedFile = $_FILES['csv_file']['tmp_name'];
                    $applicants = readCSV($uploadedFile);
                    
                    if (!empty($applicants)) {
                        if (writeCSV('data/applicants.csv', $applicants)) {
                            $message = 'CSV file imported successfully!';
                            $messageType = 'success';
                        } else {
                            $message = 'Error importing CSV file.';
                            $messageType = 'danger';
                        }
                    } else {
                        $message = 'Invalid CSV file format.';
                        $messageType = 'danger';
                    }
                } else {
                    $message = 'Please select a valid CSV file.';
                    $messageType = 'danger';
                }
                break;
        }
    }
}

// Read current applicants
$applicants = readCSV('data/applicants.csv');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Screening System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%);
            color: white;
            padding: 32px 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .btn-primary, .btn-success, .btn-info, .btn-outline-primary, .btn-danger, .btn-warning {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%) !important;
            border: none !important;
            border-radius: 25px;
            padding: 12px 30px;
            color: #fff !important;
        }
        .btn-outline-primary {
            background: transparent !important;
            color: #800000 !important;
            border: 2px solid #800000 !important;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%) !important;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
            <i class="fas fa-check-circle"></i> CCS Screening Result
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin.php">Admin Panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 24px;">
                <img src="images/ssclogo.png" alt="Logo 1" style="max-width: 120px;">
                <img src="images/ccslogo.png" alt="Logo 2" style="max-width: 120px;">
            </div>
           <!-- <h1 class="h3 mb-3">Admin Panel</h1> -->
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Add Applicant Form -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-plus"></i> Add New Applicant
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="action" value="add_applicant">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="result" class="form-label">Result</label>
                                <select class="form-select" id="result" name="result" required>
                                    <option value="">Select Result</option>
                                    <option value="Passed">Passed</option>
                                    <option value="Recommended to try another department">Recommended to try another department</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Applicant
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Import/Export Section -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-file-csv"></i> Import/Export CSV
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Import Form -->
                        <form method="POST" enctype="multipart/form-data" class="mb-3">
                            <input type="hidden" name="action" value="import_csv">
                            <div class="mb-3">
                                <label for="csv_file" class="form-label">Import CSV File</label>
                                <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                                <div class="form-text">CSV should have columns: Name, Result</div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Import CSV
                            </button>
                        </form>

                        <!-- Export Button -->
                        <a href="export_csv.php" class="btn btn-info">
                            <i class="fas fa-download"></i> Export CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applicants List -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list"></i> Current Applicants (<?php echo count($applicants) - 1; ?>)
                </h5>
            </div>
            <div class="card-body">
                <?php if (count($applicants) > 1): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Result</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i < count($applicants); $i++): ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($applicants[$i][0]); ?></td>
                                        <td>
                                            <span class="badge <?php echo strtolower($applicants[$i][1]) === 'passed' ? 'bg-success' : 'bg-warning'; ?>">
                                                <?php echo htmlspecialchars($applicants[$i][1]); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteApplicant(<?php echo $i; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center text-muted">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>No applicants found. Add some applicants or import a CSV file.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2025 Screening Result. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteApplicant(index) {
            if (confirm('Are you sure you want to delete this applicant?')) {
                // You can implement AJAX deletion here
                alert('Delete functionality can be implemented with AJAX');
            }
        }
    </script>
</body>
</html> 