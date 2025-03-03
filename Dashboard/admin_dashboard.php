<?php
include '../SQL/Database.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
  header('Location: login.php');
  exit;
}

// Obtendo todas as histórias
$sql = "SELECT stories.*, users.username FROM stories JOIN users ON stories.user_id = users.id";
$stories = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard do Admin</title>
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
  <div class="container">
    <h1>Dashboard do Admin</h1>
    <div class="stories-section">
      <h2>Todas as Histórias</h2>
      <?php if ($stories->num_rows > 0): ?>
        <ul>
          <?php while($story = $stories->fetch_assoc()): ?>
            <li>
              <h3><?php echo $story['title']; ?></h3>
              <p><?php echo $story['synopsis']; ?></p>
              <p><strong>Autor:</strong> <?php echo $story['username']; ?></p>
              <a href="../Dashboard/edit_story.php?id=<?php echo $story['id']; ?>">Editar</a>
              <a href="../Dashboard/delete_story.php?id=<?php echo $story['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta história?');">Excluir</a>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <p>Não há histórias cadastradas.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
