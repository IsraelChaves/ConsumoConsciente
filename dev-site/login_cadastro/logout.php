<?php
session_start();
session_destroy();
header("Location: ../index.html"); // ou "login.php" se preferir
exit();
?>