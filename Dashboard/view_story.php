<?php
include '../SQL/Database.php';

if (!isset($_GET['id'])) {
  die('História não encontrada.');
}

$story_id = $_GET['id'];

// Obtendo a história
$sql = "SELECT stories.*, users.username FROM stories JOIN users ON stories.user_id = users.id WHERE stories.id = '$story_id'";
$result = $conn->query($sql);
$story = $result->fetch_assoc();

if (!$story) {
  die('História não encontrada.');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title><?php echo $story['title']; ?></title>
  <link rel="stylesheet" href="../css/view_story.css">
</head>
<body>
  <div class="container">
    <div class="story-header">
      <img src="<?php echo $story['cover_image']; ?>" alt="Capa da História">
      <div class="story-info">
        <h1><?php echo $story['title']; ?></h1>
        <p><strong>Autor:</strong> <?php echo $story['username']; ?></p>
        <p><strong>Classificação:</strong> <?php echo $story['rating']; ?></p>
        <p><strong>Tags:</strong> <?php echo $story['tags']; ?></p>
        <?php if ($story['music_link']): ?>
          <audio controls>
            <source src="<?php echo $story['music_link']; ?>" type="audio/mpeg">
            Seu navegador não suporta o elemento de áudio.
          </audio>
        <?php endif; ?>
      </div>
    </div>
    <div class="story-content">
      <?php echo nl2br($story['content']); ?>
    </div>
  </div>
</body>
</html>
