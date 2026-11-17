<?php
session_start();

session_unset();
session_destroy();

// Volta para a página principal do site
header("Location: ../index.php");
exit;
?>
