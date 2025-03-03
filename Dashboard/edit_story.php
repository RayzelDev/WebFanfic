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
  die('Você não tem permissão para editar esta história.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

  $sql = "UPDATE stories SET title='$title', cover_image='$cover_image', synopsis='$synopsis', category='$category', rating='$rating', language='$language', warnings='$warnings', coauthors='$coauthors', tags='$tags', content='$content', music_link='$music_link' WHERE id='$story_id'";

  if ($conn->query($sql) === TRUE) {
    echo "<div class='success-msg'>História atualizada com sucesso!</div>";
  } else {
    echo "<div class='error-msg'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar História</title>
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
  <div class="container">
    <h1>Editar História</h1>
    <form action="" method="post">
      <label for="title">Título da História:</label>
      <input type="text" id="title" name="title" value="<?php echo $story['title']; ?>" required>
      <label for="cover_image">Link da Imagem de Capa:</label>
      <input type="url" id="cover_image" name="cover_image" value="<?php echo $story['cover_image']; ?>" required>
      <label for="synopsis">Sinopse da História:</label>
      <textarea id="synopsis" name="synopsis" rows="5" required><?php echo $story['synopsis']; ?></textarea>
      <label for="category">Categoria:</label>
      <select id="category" name="category" required>
        <option value="Favoritas" <?php if($story['category'] == 'Favoritas') echo 'selected'; ?>>Favoritas</option>
        <option value="Animes & Mangas" <?php if($story['category'] == 'Animes & Mangas') echo 'selected'; ?>>Animes & Mangas</option>
        <option value="Bandas & Musicos" <?php if($story['category'] == 'Bandas & Musicos') echo 'selected'; ?>>Bandas & Músicos</option>
        <option value="Cartoons" <?php if($story['category'] == 'Cartoons') echo 'selected'; ?>>Cartoons</option>
        <option value="Celebridades" <?php if($story['category'] == 'Celebridades') echo 'selected'; ?>>Celebridades</option>
        <option value="Filmes" <?php if($story['category'] == 'Filmes') echo 'selected'; ?>>Filmes</option>
        <option value="Games" <?php if($story['category'] == 'Games') echo 'selected'; ?>>Games</option>
        <option value="Historias Originais" <?php if($story['category'] == 'Historias Originais') echo 'selected'; ?>>Histórias Originais</option>
        <option value="Livros" <?php if($story['category'] == 'Livros') echo 'selected'; ?>>Livros</option>
        <option value="Mitologias & Lendas" <?php if($story['category'] == 'Mitologias & Lendas') echo 'selected'; ?>>Mitologias & Lendas</option>
        <option value="Quadrinhos" <?php if($story['category'] == 'Quadrinhos') echo 'selected'; ?>>Quadrinhos</option>
        <option value="Series, Novelas, Doramas & TV" <?php if($story['category'] == 'Series, Novelas, Doramas & TV') echo 'selected'; ?>>Séries, Novelas, Doramas & TV</option>
        <option value="Youtubers & Social Media Stars" <?php if($story['category'] == 'Youtubers & Social Media Stars') echo 'selected'; ?>>Youtubers & Social Media Stars</option>
      </select>
      <label for="rating">Classificação:</label>
      <select id="rating" name="rating" required>
        <option value="+Livre" <?php if($story['rating'] == '+Livre') echo 'selected'; ?>>+Livre</option>
        <option value="+16" <?php if($story['rating'] == '+16') echo 'selected'; ?>>+16</option>
        <option value="+18" <?php if($story['rating'] == '+18') echo 'selected'; ?>>+18</option>
      </select>
      <label for="language">Idioma:</label>
      <select id="language" name="language" required>
        <option value="Português" <?php if($story['language'] == 'Português') echo 'selected'; ?>>Português</option>
        <option value="Inglês" <?php if($story['language'] == 'Inglês') echo 'selected'; ?>>Inglês</option>
        <option value="Espanhol" <?php if($story['language'] == 'Espanhol') echo 'selected'; ?>>Espanhol</option>
      </select>
      <p>Selecione os avisos que se aplicam à sua história:</p>
      <input type="checkbox" id="adulterio" name="warnings[]" value="Adultério" <?php if(strpos($story['warnings'], 'Adultério') !== false) echo 'checked'; ?>>
      <label for="adulterio">Adultério</label><br>
      <input type="checkbox" id="mpreg" name="warnings[]" value="Gravidez Masculina (MPreg)" <?php if(strpos($story['warnings'], 'Gravidez Masculina (MPreg)') !== false) echo 'checked'; ?>>
      <label for="mpreg">Gravidez Masculina (MPreg)</label><br>
      <input type="checkbox" id="linguagem" name="warnings[]" value="Linguagem Imprópria" <?php if(strpos($story['warnings'], 'Linguagem Imprópria') !== false) echo 'checked'; ?>>
      <label for="linguagem">Linguagem Imprópria</label><br>
      <input type="checkbox" id="alcool" name="warnings[]" value="Álcool" <?php if(strpos($story['warnings'], 'Álcool') !== false) echo 'checked'; ?>>
      <label for="alcool">Álcool</label><br>
      <input type="checkbox" id="heterossexualidade" name="warnings[]" value="Heterossexualidade" <?php if(strpos($story['warnings'], 'Heterossexualidade') !== false) echo 'checked'; ?>>
      <label for="heterossexualidade">Heterossexualidade</label><br>
      <input type="checkbox" id="sexo" name="warnings[]" value="Sexo" <?php if(strpos($story['warnings'], 'Sexo') !== false) echo 'checked'; ?>>
      <label for="sexo">Sexo</label><br>
      <input type="checkbox" id="bdsm" name="warnings[]" value="BDSM" <?php if(strpos($story['warnings'], 'BDSM') !== false) echo 'checked'; ?>>
      <label for="bdsm">BDSM</label><br>
      <input type="checkbox" id="homossexualidade" name="warnings[]" value="Homossexualidade" <?php if(strpos($story['warnings'], 'Homossexualidade') !== false) echo 'checked'; ?>>
      <label for="homossexualidade">Homossexualidade</label><br>
      <input type="checkbox" id="spoilers" name="warnings[]" value="Spoilers" <?php if(strpos($story['warnings'], 'Spoilers') !== false) echo 'checked'; ?>>
      <label for="spoilers">Spoilers</label><br>
      <input type="checkbox" id="bissexualidade" name="warnings[]" value="Bissexualidade" <?php if(strpos($story['warnings'], 'Bissexualidade') !== false) echo 'checked'; ?>>
      <label for="bissexualidade">Bissexualidade</label><br>
      <input type="checkbox" id="insinuacao" name="warnings[]" value="Insinuação de sexo" <?php if(strpos($story['warnings'], 'Insinuação de sexo') !== false) echo 'checked'; ?>>
      <label for="insinuacao">Insinuação de sexo</label><br>
      <input type="checkbox" id="suicidio" name="warnings[]" value="Suicídio" <?php if(strpos($story['warnings'], 'Suicídio') !== false) echo 'checked'; ?>>
      <label for="suicidio">Suicídio</label><br>
      <input type="checkbox" id="drogas" name="warnings[]" value="Drogas" <?php if(strpos($story['warnings'], 'Drogas') !== false) echo 'checked'; ?>>
      <label for="drogas">Drogas</label><br>
      <input type="checkbox" id="intersexualidade" name="warnings[]" value="Intersexualidade (G!P)" <?php if(strpos($story['warnings'], 'Intersexualidade (G!P)') !== false) echo 'checked'; ?>>
      <label for="intersexualidade">Intersexualidade (G!P)</label><br>
      <input type="checkbox" id="violencia" name="warnings[]" value="Violência" <?php if(strpos($story['warnings'], 'Violência') !== false) echo 'checked'; ?>>
      <label for="violencia">Violência</label><br><br>

      <label for="coauthors">Coautores da História:</label>
      <input type="text" id="coauthors" name="coauthors" value="<?php echo $story['coauthors']; ?>"><br><br>

      <label for="tags">Tags da História:</label>
      <input type="text" id="tags" name="tags" value="<?php echo $story['tags']; ?>"><br><br>

      <label for="content">Conteúdo da História:</label>
      <textarea id="content" name="content" rows="10" required><?php echo $story['content']; ?></textarea><br><br>

      <label for="music_link">Link da Música:</label>
      <input type="url" id="music_link" name="music_link" value="<?php echo $story['music_link']; ?>"><br><br>

      <input type="submit" value="Atualizar História">
    </form>
  </div>
</body>
</html>
