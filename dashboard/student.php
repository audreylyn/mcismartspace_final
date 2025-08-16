<?php
session_start();
require_once '../middleware/auth_middleware.php';

$auth = new AuthMiddleware();
$auth->requireRole('Student');
$user = $auth->getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - SmartSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #fd7e14 0%, #e83e8c 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .stats-card {
            background: linear-gradient(135deg, #fd7e14 0%, #e83e8c 100%);
            color: white;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar p-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white"><i class="fas fa-user-graduate"></i> SmartSpace</h4>
                        <small class="text-white-50">Student Portal</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="#courses">
                            <i class="fas fa-book me-2"></i> My Courses
                        </a>
                        <a class="nav-link" href="#grades">
                            <i class="fas fa-star me-2"></i> Grades
                        </a>
                        <a class="nav-link" href="#attendance">
                            <i class="fas fa-calendar-check me-2"></i> Attendance
                        </a>
                        <a class="nav-link" href="#assignments">
                            <i class="fas fa-tasks me-2"></i> Assignments
                        </a>
                        <a class="nav-link" href="#schedule">
                            <i class="fas fa-calendar-alt me-2"></i> Schedule
                        </a>
                        <a class="nav-link" href="#profile">
                            <i class="fas fa-user me-2"></i> Profile
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="navbar-nav ms-auto">
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($user['name']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="#settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Dashboard Content -->
                <div class="main-content p-4">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="mb-3">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
                            <p class="text-muted">Program: Bachelor of Science in Computer Science | Year: 3rd Year | Section: A</p>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-book fa-2x mb-2"></i>
                                    <h4>6</h4>
                                    <p class="mb-0">Enrolled Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-star fa-2x mb-2"></i>
                                    <h4>3.85</h4>
                                    <p class="mb-0">GPA</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                    <h4>92%</h4>
                                    <p class="mb-0">Attendance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-tasks fa-2x mb-2"></i>
                                    <h4>5</h4>
                                    <p class="mb-0">Pending Tasks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Courses and Schedule -->
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-book me-2"></i>Current Courses</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Course Code</th>
                                                    <th>Course Name</th>
                                                    <th>Teacher</th>
                                                    <th>Schedule</th>
                                                    <th>Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>CS301</td>
                                                    <td>Web Development</td>
                                                    <td>Dr. Smith</td>
                                                    <td>Mon/Wed 8:00 AM</td>
                                                    <td><span class="badge bg-success">A</span></td>
                                                </tr>
                                                <tr>
                                                    <td>CS302</td>
                                                    <td>Database Systems</td>
                                                    <td>Prof. Johnson</td>
                                                    <td>Tue/Thu 10:00 AM</td>
                                                    <td><span class="badge bg-warning">B+</span></td>
                                                </tr>
                                                <tr>
                                                    <td>CS303</td>
                                                    <td>Programming Fundamentals</td>
                                                    <td>Dr. Williams</td>
                                                    <td>Mon/Wed 2:00 PM</td>
                                                    <td><span class="badge bg-info">A-</span></td>
                                                </tr>
                                                <tr>
                                                    <td>CS304</td>
                                                    <td>Data Structures</td>
                                                    <td>Prof. Brown</td>
                                                    <td>Tue/Thu 2:00 PM</td>
                                                    <td><span class="badge bg-success">A</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Today's Schedule</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>8:00 AM</strong><br>
                                                <small>Web Development</small>
                                            </div>
                                            <span class="badge bg-primary">Room 101</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>10:00 AM</strong><br>
                                                <small>Database Systems</small>
                                            </div>
                                            <span class="badge bg-success">Room 203</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>2:00 PM</strong><br>
                                                <small>Programming</small>
                                            </div>
                                            <span class="badge bg-info">Lab 1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-bell me-2"></i>Notifications</h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-sm">
                                        <small>Assignment due tomorrow: Web Development Project</small>
                                    </div>
                                    <div class="alert alert-info alert-sm">
                                        <small>New grade posted for Database Systems</small>
                                    </div>
                                    <div class="alert alert-success alert-sm">
                                        <small>Schedule updated for next week</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
