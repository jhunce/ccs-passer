<?php
session_start();

// Check if result exists in session
if (!isset($_SESSION['screening_result'])) {
    header('Location: index.php');
    exit;
}

$result = $_SESSION['screening_result'];
$isPassed = strtolower($result['result']) === 'passed';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screening Result - <?php echo htmlspecialchars($result['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #800000 0%, #b22222 100%);
            color: white;
            padding: 32px 0;
        }
        .result-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .result-card:hover {
            transform: translateY(-5px);
        }
        .result-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .passed {
            color: #28a745;
        }
        .recommended {
            color: #ffc107;
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
           <!-- <h1 class="h3 mb-3">Screening Results</h1> -->

        </div>
    </section>

    <!-- Result Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card result-card">
                    <div class="card-body p-5 text-center">
                        <div class="result-icon <?php echo $isPassed ? 'passed' : 'recommended'; ?>">
                            <?php if ($isPassed): ?>
                                <i class="fas fa-check-circle"></i>
                            <?php else: ?>
                                <i class="fas fa-info-circle"></i>
                            <?php endif; ?>
                        </div>
                        
                        <h2 class="card-title mb-4">
                            <?php echo htmlspecialchars($result['name']); ?>
                        </h2>
                        
                        <div class="alert <?php echo $isPassed ? 'alert-success' : 'alert-warning'; ?> mb-4">
                            <h4 class="alert-heading">
                                <?php if ($isPassed): ?>
                                    <i class="fas fa-trophy"></i> Congratulations!
                                <?php else: ?>
                                    <i class="fas fa-lightbulb"></i> Recommendation
                                <?php endif; ?>
                            </h4>
                            <p class="mb-0">
                                <?php if ($isPassed): ?>
                                    <strong>PASSED</strong><br>
                                    You have successfully passed the screening process. 
                                    Please proceed with the next steps in your department.
                                <?php else: ?>
                                    <strong>RECOMMENDED TO TRY ANOTHER DEPARTMENT</strong><br>
                                    While you didn't pass this screening, we encourage you to 
                                    apply to other departments that might be a better fit for your skills.
                                <?php endif; ?>
                            </p>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-outline-primary btn-lg w-100">
                                    <i class="fas fa-home"></i> Back to Home
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button onclick="window.print()" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-print"></i> Print Result
                                </button>
                            </div>
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
</body>
</html> 