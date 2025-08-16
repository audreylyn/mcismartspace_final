<?php
session_start();
require_once 'middleware/auth_middleware.php';

$auth = new AuthMiddleware();
$auth->logout();
?>
