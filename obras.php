<?php
include 'SQL/Database.php';

// Definindo variáveis para filtros e ordenação
$search_title = isset($_GET['search_title']) ? $_GET['search_title'] : '';
$search_rating = isset($_GET['search_rating']) ? $_GET['search_rating'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'created_at';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'DESC';

// Construindo a query com filtros
$sql = "SELECT * FROM stories WHERE title LIKE '%$search_title%'";

if ($search_rating != '') {
  $sql .= " AND rating = '$search_rating'";
}

$sql .= " ORDER BY $order_by $order_dir";

$stories = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Obras</title>
  <link rel="stylesheet" href="css/obras.css">
</head>
<body>
  <div class="container">
    <h1>Obras</h1>
    <div class="filter-section">
      <form action="" method="get">
        <label for="search_title">Buscar por título:</label>
        <input type="text" id="search_title" name="search_title" value="<?php echo $search_title; ?>">
        
        <label for="search_rating">Classificação:</label>
        <select id="search_rating" name="search_rating">
          <option value="">Todas</option>
          <option value="+Livre" <?php if ($search_rating == '+Livre') echo 'selected'; ?>>+Livre</option>
          <option value="+16" <?php if ($search_rating == '+16') echo 'selected'; ?>>+16</option>
          <option value="+18" <?php if ($search_rating == '+18') echo 'selected'; ?>>+18</option>
        </select>

        <label for="order_by">Ordenar por:</label>
        <select id="order_by" name="order_by">
          <option value="created_at" <?php if ($order_by == 'created_at') echo 'selected'; ?>>Data de Criação</option>
          <option value="title" <?php if ($order_by == 'title') echo 'selected'; ?>>Título</option>
        </select>

        <label for="order_dir">Ordem:</label>
        <select id="order_dir" name="order_dir">
          <option value="DESC" <?php if ($order_dir == 'DESC') echo 'selected'; ?>>Decrescente</option>
          <option value="ASC" <?php if ($order_dir == 'ASC') echo 'selected'; ?>>Crescente</option>
        </select>

        <input type="submit" value="Aplicar Filtros">
      </form>
    </div>

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
