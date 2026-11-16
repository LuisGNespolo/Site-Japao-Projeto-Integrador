
<?php
session_start();

// Encerra a sessão do administrador
session_unset();
session_destroy();

// Redireciona para a página principal
header("Location: ../index.php");
exit;
?>
