<?php
include 'SQL/Database.php';

// Query para top 3 autores da semana
$top_authors_sql = "
SELECT users.id, users.username, users.profile_picture, COUNT(stories.id) AS story_count
FROM stories
JOIN users ON stories.user_id = users.id
WHERE YEARWEEK(stories.created_at, 1) = YEARWEEK(CURDATE(), 1)
GROUP BY users.id, users.username, users.profile_picture
ORDER BY story_count DESC
LIMIT 3
";
$top_authors = $conn->query($top_authors_sql);

// Query para top 10 livros da semana
$top_books_sql = "
SELECT * FROM stories
WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)
ORDER BY views DESC
LIMIT 10
";
$top_books = $conn->query($top_books_sql);

// Query para os 5 livros mais recentes
$recent_books_sql = "
SELECT * FROM stories
ORDER BY created_at DESC
LIMIT 5
";
$recent_books = $conn->query($recent_books_sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Neverland</title>
</head>
<body>
    <header>
        <?php include('menu.php') ?>
    </header>
    <main class="container">
        <div class="content">
            <aside class="sidebar">
            <section class="ranking">
                <h2>Top 3 Autores da Semana</h2>
                <ul class="index-list">
                    <?php while($author = $top_authors->fetch_assoc()): ?>
                        <li class="index-list-item">
                            <img src="<?php echo $author['profile_picture']; ?>" alt="Foto de perfil">
                            <div>
                                <h3><?php echo $author['username']; ?></h3>
                                <p>Histórias publicadas: <?php echo $author['story_count']; ?></p>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
            <section class="ranking">
                <h2>Top 10 Livros da Semana</h2>
                <ul class="index-list">
                    <?php while($book = $top_books->fetch_assoc()): ?>
                        <li class="index-list-item">
                            <img src="<?php echo $book['cover_image']; ?>" alt="Capa do livro">
                            <div>
                                <h3><?php echo $book['title']; ?></h3>
                                <p><?php echo $book['synopsis']; ?></p>
                                <p>Visualizações: <?php echo $book['views']; ?></p>
                                <a href="Dashboard/view_story.php?id=<?php echo $book['id']; ?>" class="btn-link">Ler História</a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
            <section class="main-content">
                <h2>Livros Mais Recentes</h2>
                <ul class="index-list">
                    <?php while($book = $recent_books->fetch_assoc()): ?>
                        <li class="index-list-item">
                            <img src="<?php echo $book['cover_image']; ?>" alt="Capa do livro">
                            <div>
                                <h3><?php echo $book['title']; ?></h3>
                                <p><?php echo $book['synopsis']; ?></p>
                                <a href="Dashboard/view_story.php?id=<?php echo $book['id']; ?>" class="btn-link">Ler História</a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>

        </div>
        <section class="support">
            <h2>Suporte</h2>
            <form action="submit_support.php" method="POST">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Mensagem:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                <input type="submit" value="Enviar" class="btn-submit">
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Neverland. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
