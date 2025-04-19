<?php
    include __DIR__ . "/app/db.php";
    $conn = Database::get_instance();

    
$users = [
    ['username' => 'admin_jane',  'password' => 'janeAdmin123',  'email' => 'jane.admin@example.com',  'urole' => 'admin'],
    ['username' => 'admin_mike',  'password' => 'mikeAdmin123',  'email' => 'mike.admin@example.com',  'urole' => 'admin'],
    ['username' => 'user_sara',   'password' => 'saraUser123',   'email' => 'sara.user@example.com',   'urole' => 'user'],
    ['username' => 'user_tom',    'password' => 'tomUser123',    'email' => 'tom.user@example.com',    'urole' => 'user'],
    ['username' => 'user_emily',  'password' => 'emilyUser123',  'email' => 'emily.user@example.com',  'urole' => 'user'],
];

$sql = "INSERT INTO users (username, password, email, urole) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

foreach ($users as $user) {
    $pass =  password_hash($user['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $user['username'], $pass, $user['email'], $user['urole']);
    $stmt->execute();
}

echo "insert users succeed";

?>