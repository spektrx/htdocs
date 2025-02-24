<?php

$dsn = "mysql:host=localhost; port=3306; dbname=transactions; user=root; password=";

$pdo = new PDO($dsn, "root", "", array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


?>


