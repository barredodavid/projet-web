<?php
session_start();
session_unset();
session_destroy();
header('Location:http://localhost/website/page_acceuil/Jobboard.php');
?>