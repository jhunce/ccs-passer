<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screening Result</title>
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
        .result-card {
            transition: transform 0.3s ease;
        }
        .result-card:hover {
            transform: translateY(-5px);
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
          <!--  <h1 class="h3 mb-3">College of Computing Studies</h1> -->
            
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">
                            <i class="fas fa-user-check text-primary"></i> Check Your Results
                        </h3>
                        
                        <?php
                        // Display messages if any
                        if (isset($_GET['message'])) {
                            $message = $_GET['message'];
                            $alertClass = (strpos($message, 'success') !== false) ? 'alert-success' : 'alert-danger';
                            echo "<div class='alert $alertClass alert-dismissible fade show' role='alert'>
                                    $message
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                  </div>";
                        }
                        ?>

                        <form action="process_screening.php" method="POST">
                            <div class="mb-4">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control form-control-lg" id="fullName" name="fullName" 
                                       placeholder="Enter your full name (e.g. Jose Rizal)" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search"></i> Check Results
                                </button>
                            </div>
                        </form>
                    </div>
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