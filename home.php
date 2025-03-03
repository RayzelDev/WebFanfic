<html>
<link rel="stylesheet" href="css/index.css">

    <body>

<main class="container">
        <div class="content">
            <aside class="sidebar">
                <section class="ranking">
                    <h2>Top 3 Autores da Semana</h2>
                    <ul>
                        <?php while($author = $top_authors->fetch_assoc()): ?>
                            <li>
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
                    <ul>
                        <?php while($book = $top_books->fetch_assoc()): ?>
                            <li>
                                <img src="<?php echo $book['cover_image']; ?>" alt="Capa do livro">
                                <div>
                                    <h3><?php echo $book['title']; ?></h3>
                                    <p><?php echo $book['synopsis']; ?></p>
                                    <p>Visualizações: <?php echo $book['views']; ?></p>
                                    <a href="Dashboard/view_story.php?id=<?php echo $book['id']; ?>">Ler História</a>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </section>
            </aside>
            <section class="main-content">
                <h2>Livros Mais Recentes</h2>
                <ul>
                    <?php while($book = $recent_books->fetch_assoc()): ?>
                        <li>
                            <img src="<?php echo $book['cover_image']; ?>" alt="Capa do livro">
                            <div>
                                <h3><?php echo $book['title']; ?></h3>
                                <p><?php echo $book['synopsis']; ?></p>
                                <a href="Dashboard/view_story.php?id=<?php echo $book['id']; ?>">Ler História</a>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </div>
    </main>
    </body>
</html>