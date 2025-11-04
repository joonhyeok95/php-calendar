<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Digital Clock - 디지털 시계</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-clock me-2"></i>Digital Clock
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Clock Section -->
    <div class="clock-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <!-- Digital Clock Display -->
                    <div class="clock-wrapper">
                        <div class="date-display mb-4" id="dateDisplay">
                            <span id="dayOfWeek"></span>
                            <span id="fullDate"></span>
                        </div>
                        
                        <div class="clock-display" id="clockDisplay">
                            <div class="time-segment">
                                <span class="time-digit" id="hours">00</span>
                                <span class="time-label">Hours</span>
                            </div>
                            <span class="time-separator">:</span>
                            <div class="time-segment">
                                <span class="time-digit" id="minutes">00</span>
                                <span class="time-label">Minutes</span>
                            </div>
                            <span class="time-separator">:</span>
                            <div class="time-segment">
                                <span class="time-digit" id="seconds">00</span>
                                <span class="time-label">Seconds</span>
                            </div>
                        </div>

                        <div class="period-display mt-3" id="periodDisplay">
                            <span class="period-badge">AM</span>
                        </div>

                        <!-- Additional Info -->
                        <div class="additional-info mt-5">
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="info-card">
                                        <i class="fas fa-calendar-day"></i>
                                        <span id="dayOfYear">1</span>
                                        <small>Day of Year</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-card">
                                        <i class="fas fa-calendar-week"></i>
                                        <span id="weekOfYear">1</span>
                                        <small>Week of Year</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-card">
                                        <i class="fas fa-hourglass-half"></i>
                                        <span id="timezone">UTC+9</span>
                                        <small>Timezone</small>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-card">
                                        <i class="fas fa-heartbeat"></i>
                                        <span id="heartbeat">♥</span>
                                        <small>Live</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Theme Toggle -->
                        <div class="theme-controls mt-4">
                            <button class="btn btn-theme" id="themeToggle">
                                <i class="fas fa-moon"></i> Dark Mode
                            </button>
                            <button class="btn btn-theme ms-2" id="formatToggle">
                                <i class="fas fa-clock"></i> 12H/24H
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Digital Clock. Made with <i class="fas fa-heart text-danger"></i></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="js/clock.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>
