<?php
include '../SQL/Database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$story_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Obtendo a história
$sql = "SELECT * FROM stories WHERE id='$story_id'";
$result = $conn->query($sql);
$story = $result->fetch_assoc();

if (!$story) {
  die('História não encontrada.');
}

// Verificando permissão
if ($story['user_id'] != $user_id && $role != 2) {
  die('Você não tem permissão para deletar esta história.');
}

// Deletando a história
$sql = "DELETE FROM stories WHERE id='$story_id'";

if ($conn->query($sql) === TRUE) {
  header('Location: user_dashboard.php');
  exit;
} else {
  echo "Erro ao deletar a história: " . $conn->error;
}

$conn->close();
?>
