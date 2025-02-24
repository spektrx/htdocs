<?php




require_once("db.php");

function findUserByID($id){   
    global $pdo;

    $query = "SELECT * FROM Users WHERE id = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    return $stmt->fetch();
}

function findAllUsers() {
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM Users"); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}



function getUserTransactions($userId) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM transactions_in WHERE id = ?');
    $stmt->execute([$userId]);

    return $stmt->fetchAll();
}


function getTransactionsOut() {
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM transactions_out");

    return $stmt->fetchAll();
}

function getUsersOutTransactions(){
    global $pdo;

    $stmt = $pdo->query("SELECT Users.name, transactions_out.sum FROM `transactions_out` JOIN Users ON transactions_out.user_id = Users.id");

    return $stmt->fetchAll();  
}

function transfer($senderId, $receiverId, $amount) {
    global $pdo;

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('SELECT balance FROM Users WHERE id = ?');
        $stmt->execute([$senderId]);
        $senderBalance = $stmt->fetchColumn();

        if ($senderBalance === false || $senderBalance < $amount) {
            throw new Exception("Недостаточно средств!");
        }

        $sender = findUserByID($senderId);
        $receiver = findUserByID($receiverId);

        $stmt = $pdo->prepare("INSERT INTO transactions (sender_id, receiver_id, sender_name, receiver_name, operation_type, amount) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([$senderId, $receiverId, $sender["name"], $receiver["name"], "transfer", $amount]);

        $stmt = $pdo->prepare('UPDATE Users SET balance = balance - ? WHERE id = ?');
        $stmt->execute([$amount, $senderId]);

        $stmt = $pdo->prepare('UPDATE Users SET balance = balance + ? WHERE id = ?');
        $stmt->execute([$amount, $receiverId]);

        $pdo->commit();
        return "Перевод выполнен успешно!";
    } catch (Exception $e) {
        $pdo->rollBack();
        return "Ошибка: " . $e->getMessage();
    }
}
