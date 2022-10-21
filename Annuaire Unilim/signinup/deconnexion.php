<?php
session_start();

unset($_SESSION); // détruire la variable globale $_SESSION
setcookie(session_name(), '', -10);
session_destroy(); // détruire la session
header("Location:../index.php");