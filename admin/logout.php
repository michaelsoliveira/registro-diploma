<?php

session_start();
unset($_SESSION['estado']);
header('Location: index.php');

?>