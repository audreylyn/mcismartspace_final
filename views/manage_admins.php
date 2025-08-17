<?php
session_start();
require_once '../middleware/auth_middleware.php';

$auth = new AuthMiddleware();
$auth->requireRole('Registrar');
$user = $auth->getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layout/head.php"; ?>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include "./layout/reg_sidebar.php"; ?>
            <?php include "./layout/topnav.php"; ?>
            
            <!-- Page content -->
            <main class="right_col" role="main">
                <article>
                    <header>
                        <h1 class="sr-only">Manage Admins</h1>
                    </header>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Main content goes here -->
                            </div>
                        </div>
                    </section>
                </article>
            </main>

            <?php include "./layout/footer.php"; ?>
        </div>
    </div>

    <?php include "./layout/scripts.php"; ?>
</body>

</html>