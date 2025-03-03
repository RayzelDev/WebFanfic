<?php
include '../SQL/Database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];

    $sql = "UPDATE users SET username='$username', email='$email', cell='$cell' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
      echo "<div class='success-msg'>Perfil atualizado com sucesso!</div>";
    } else {
      echo "<div class='error-msg'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
  } elseif (isset($_POST['create_story'])) {
    $title = $_POST['title'];
    $cover_image = $_POST['cover_image'];
    $synopsis = $_POST['synopsis'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $language = $_POST['language'];
    $warnings = isset($_POST['warnings']) ? implode(", ", $_POST['warnings']) : '';
    $coauthors = $_POST['coauthors'];
    $tags = $_POST['tags'];
    $content = $_POST['content'];
    $music_link = $_POST['music_link'];

    $sql = "INSERT INTO stories (title, cover_image, synopsis, category, rating, language, warnings, coauthors, tags, content, music_link, user_id) 
            VALUES ('$title', '$cover_image', '$synopsis', '$category', '$rating', '$language', '$warnings', '$coauthors', '$tags', '$content', '$music_link', '$user_id')";

    if ($conn->query($sql) === TRUE) {
      echo "<div class='success-msg'>Nova história criada com sucesso!</div>";
    } else {
      echo "<div class='error-msg'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
    }
  }
}

// Obtendo as informações do usuário
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Obtendo as histórias do usuário
$sql = "SELECT * FROM stories WHERE user_id='$user_id'";
$stories = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Dashboard do Usuário</title>
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
  <div class="container">
    <h1>Dashboard do Usuário</h1>
    <div class="profile-section">
      <h2>Atualizar Perfil</h2>
      <form action="" method="post">
        <input type="hidden" name="update_profile">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        <label for="cell">Celular:</label>
        <input type="tel" id="cell" name="cell" value="<?php echo $user['cell']; ?>" required>
        <input type="submit" value="Atualizar Perfil">
      </form>
    </div>

    <div class="story-section">
      <h2>Criar Nova História</h2>
      <form action="" method="post">
        <input type="hidden" name="create_story">
        <label for="title">Título da História:</label>
        <input type="text" id="title" name="title" required>
        <label for="cover_image">Link da Imagem de Capa:</label>
        <input type="url" id="cover_image" name="cover_image" required>
        <label for="synopsis">Sinopse da História:</label>
        <textarea id="synopsis" name="synopsis" rows="5" required></textarea>
        <label for="category">Categoria:</label>
        <select id="category" name="category" required>
          <option value="Favoritas">Favoritas</option>
          <option value="Animes & Mangas">Animes & Mangas</option>
          <option value="Bandas & Musicos">Bandas & Músicos</option>
          <option value="Cartoons">Cartoons</option>
          <option value="Celebridades">Celebridades</option>
          <option value="Filmes">Filmes</option>
          <option value="Games">Games</option>
          <option value="Historias Originais">Histórias Originais</option>
          <option value="Livros">Livros</option>
          <option value="Mitologias & Lendas">Mitologias & Lendas</option>
          <option value="Quadrinhos">Quadrinhos</option>
          <option value="Series, Novelas, Doramas & TV">Séries, Novelas, Doramas & TV</option>
          <option value="Youtubers & Social Media Stars">Youtubers & Social Media Stars</option>
        </select>
        <label for="rating">Classificação:</label>
        <select id="rating" name="rating" required>
          <option value="+Livre">+Livre</option>
          <option value="+16">+16 (Dezesseis)</option>
          <option value="+18">+18 (Dezoito)</option>
        </select>
        <label for="language">Idioma:</label>
        <select id="language" name="language" required>
          <option value="Português">Português</option>
          <option value="Inglês">Inglês</option>
          <option value="Espanhol">Espanhol</option>
        </select>
        <p>Selecione os avisos que se aplicam à sua história:</p>
        <input type="checkbox" id="adulterio" name="warnings[]" value="Adultério">
        <label for="adulterio">Adultério</label><br>
        <input type="checkbox" id="mpreg" name="warnings[]" value="Gravidez Masculina (MPreg)">
        <label for="mpreg">Gravidez Masculina (MPreg)</label><br>
        <input type="checkbox" id="linguagem" name="warnings[]" value="Linguagem Imprópria">
        <label for="linguagem">Linguagem Imprópria</label><br>
        <input type="checkbox" id="alcool" name="warnings[]" value="Álcool">
        <label for="alcool">Álcool</label><br>
        <input type="checkbox" id="heterossexualidade" name="warnings[]" value="Heterossexualidade">
        <label for="heterossexualidade">Heterossexualidade</label><br>
        <input type="checkbox" id="sexo" name="warnings[]" value="Sexo">
        <label for="sexo">Sexo</label><br>
        <input type="checkbox" id="bdsm" name="warnings[]" value="BDSM">
        <label for="bdsm">BDSM</label><br>
        <input type="checkbox" id="homossexualidade" name="warnings[]" value="Homossexualidade">
        <label for="homossexualidade">Homossexualidade</label><br>
        <input type="checkbox" id="spoilers" name="warnings[]" value="Spoilers">
        <label for="spoilers">Spoilers</label><br>
        <input type="checkbox" id="bissexualidade" name="warnings[]" value="Bissexualidade">
        <label for="bissexualidade">Bissexualidade</label><br>
      <input type="checkbox" id="insinuacao" name="warnings[]" value="Insinuação de sexo">
      <label for="insinuacao">Insinuação de sexo</label><br>
      <input type="checkbox" id="suicidio" name="warnings[]" value="Suicídio">
      <label for="suicidio">Suicídio</label><br>
      <input type="checkbox" id="drogas" name="warnings[]" value="Drogas">
      <label for="drogas">Drogas</label><br>
      <input type="checkbox" id="intersexualidade" name="warnings[]" value="Intersexualidade (G!P)">
      <label for="intersexualidade">Intersexualidade (G!P)</label><br>
      <input type="checkbox" id="violencia" name="warnings[]" value="Violência">
      <label for="violencia">Violência</label><br><br>

      <label for="coauthors">Coautores da História:</label>
      <input type="text" id="coauthors" name="coauthors"><br><br>

      <label for="tags">Tags da História:</label>
      <input type="text" id="tags" name="tags"><br><br>

      <label for="content">Conteúdo da História:</label>
      <textarea id="content" name="content" rows="10" required></textarea><br><br>

      <label for="music_link">Link da Música:</label>
      <input type="url" id="music_link" name="music_link"><br><br>

      <input type="submit" value="Criar História">
    </form>
  </div>

  <div class="stories-section">
    <h2>Minhas Histórias</h2>
    <?php if ($stories->num_rows > 0): ?>
      <ul>
        <?php while($story = $stories->fetch_assoc()): ?>
          <li>
            <h3><?php echo $story['title']; ?></h3>
            <p><?php echo $story['synopsis']; ?></p>
            <a href="edit_story.php?id=<?php echo $story['id']; ?>">Editar</a>
            <a href="delete_story.php?id=<?php echo $story['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta história?');">Excluir</a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>Você ainda não criou nenhuma história.</p>
    <?php endif; ?>
  </div>
</body>
</html>
