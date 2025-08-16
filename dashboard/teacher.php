<?php
session_start();
require_once '../middleware/auth_middleware.php';

$auth = new AuthMiddleware();
$auth->requireRole('Teacher');
$user = $auth->getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - SmartSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
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
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
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
                        <h4 class="text-white"><i class="fas fa-chalkboard-teacher"></i> SmartSpace</h4>
                        <small class="text-white-50">Teacher Portal</small>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="#courses">
                            <i class="fas fa-book me-2"></i> My Courses
                        </a>
                        <a class="nav-link" href="#students">
                            <i class="fas fa-user-graduate me-2"></i> Students
                        </a>
                        <a class="nav-link" href="#attendance">
                            <i class="fas fa-calendar-check me-2"></i> Attendance
                        </a>
                        <a class="nav-link" href="#grades">
                            <i class="fas fa-star me-2"></i> Grades
                        </a>
                        <a class="nav-link" href="#assignments">
                            <i class="fas fa-tasks me-2"></i> Assignments
                        </a>
                        <a class="nav-link" href="#schedule">
                            <i class="fas fa-calendar-alt me-2"></i> Schedule
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
                            <p class="text-muted">Department: Computer Science</p>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-book fa-2x mb-2"></i>
                                    <h4>4</h4>
                                    <p class="mb-0">Active Courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-graduate fa-2x mb-2"></i>
                                    <h4>120</h4>
                                    <p class="mb-0">Total Students</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock fa-2x mb-2"></i>
                                    <h4>18</h4>
                                    <p class="mb-0">Teaching Hours</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card stats-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-tasks fa-2x mb-2"></i>
                                    <h4>8</h4>
                                    <p class="mb-0">Pending Tasks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Today's Schedule -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Today's Schedule</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Course</th>
                                                    <th>Room</th>
                                                    <th>Students</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>8:00 AM</td>
                                                    <td>Web Development</td>
                                                    <td>Room 101</td>
                                                    <td>30</td>
                                                    <td><button class="btn btn-sm btn-primary">Take Attendance</button></td>
                                                </tr>
                                                <tr>
                                                    <td>10:00 AM</td>
                                                    <td>Database Systems</td>
                                                    <td>Room 203</td>
                                                    <td>25</td>
                                                    <td><button class="btn btn-sm btn-primary">Take Attendance</button></td>
                                                </tr>
                                                <tr>
                                                    <td>2:00 PM</td>
                                                    <td>Programming Fundamentals</td>
                                                    <td>Lab 1</td>
                                                    <td>35</td>
                                                    <td><button class="btn btn-sm btn-primary">Take Attendance</button></td>
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
                                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Create Assignment
                                        </button>
                                        <button class="btn btn-success">
                                            <i class="fas fa-edit me-2"></i>Update Grades
                                        </button>
                                        <button class="btn btn-info">
                                            <i class="fas fa-calendar me-2"></i>View Schedule
                                        </button>
                                        <button class="btn btn-warning">
                                            <i class="fas fa-chart-bar me-2"></i>View Reports
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-bell me-2"></i>Notifications</h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info alert-sm">
                                        <small>New assignment submission from John Doe</small>
                                    </div>
                                    <div class="alert alert-warning alert-sm">
                                        <small>Grade deadline approaching</small>
                                    </div>
                                    <div class="alert alert-success alert-sm">
                                        <small>Course schedule updated</small>
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
