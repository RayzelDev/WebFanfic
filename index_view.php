<?php
include 'SQL/Database.php';

// Obtendo todas as histórias
$sql = "SELECT * FROM stories";
$stories = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/index_view.css">
</head>
<body>
  <div class="container">
    <h1>Obras Recentes</h1>
    <div class="stories-section">
      <?php if ($stories->num_rows > 0): ?>
        <ul>
          <?php while($story = $stories->fetch_assoc()): ?>
            <li>
              <img src="<?php echo $story['cover_image']; ?>" alt="Capa da História">
              <div class="story-info">
                <h3><?php echo $story['title']; ?></h3>
                <p><?php echo $story['synopsis']; ?></p>
                <p><strong>Classificação:</strong> <?php echo $story['rating']; ?></p>
                <p><strong>Tags:</strong> <?php echo $story['tags']; ?></p>
                <a href="../Dashboard/view_story.php?id=<?php echo $story['id']; ?>">Ler História</a>
              </div>
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
