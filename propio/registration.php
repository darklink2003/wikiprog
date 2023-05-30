<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Connect to the database
$host = 'your_host';
$dbname = 'your_database_name';
$username = 'your_username';
$password_db = 'your_password';

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password_db);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement
  $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

  // Bind the parameters
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);

  // Execute the statement
  $stmt->execute();

  // Redirect to a success page
  header('Location: success.html');
} catch (PDOException $e) {
  // Redirect to an error page
  header('Location: error.html');
  exit;
}
