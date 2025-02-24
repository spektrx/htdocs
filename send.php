<?php
header("Content-Type: application/json"); // Указываем, что ответ — JSON
require_once "db-controller.php";

$sender = (int) $_POST["SenderId"];
$receiver = (int) $_POST["ReceiverId"];
$amount = (int) $_POST["Amount"];

$result = transfer($sender, $receiver, $amount);

echo json_encode(["success" => true, "message" => $result]); 
exit(); // Прерываем выполнение скрипта
?>
