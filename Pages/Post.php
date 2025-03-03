<?php
include '../SQL/Database.php';

session_start();
if (!isset($_SESSION['user_id'])) {
  die("Usuário não está logado.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['titule'];
  $cover_image = $_POST['link'];
  $synopsis = $_POST['history'];
  $category = $_POST['category'];
  $rating = $_POST['rating'];
  $language = $_POST['language'];
  $warnings = isset($_POST['warnings']) ? implode(", ", $_POST['warnings']) : '';
  $coauthors = $_POST['coauthors'];
  $tags = $_POST['tags'];

  $sql = "INSERT INTO stories (title, cover_image, synopsis, category, rating, language, warnings, coauthors, tags, user_id) 
          VALUES ('$title', '$cover_image', '$synopsis', '$category', '$rating', '$language', '$warnings', '$coauthors', '$tags', '$user_id')";

  if ($conn->query($sql) === TRUE) {
    echo "<div class='success-msg'>Nova história criada com sucesso!</div>";
  } else {
    echo "<div class='error-msg'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Enviar História</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }
    .container {
      width: 50%;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h3 {
      margin-top: 0;
    }
    label, p {
      margin: 10px 0 5px;
    }
    input[type="text"], input[type="url"], textarea, select {
      width: 100%;
      padding: 10px;
      margin: 5px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    input[type="checkbox"] {
      margin-right: 10px;
    }
    .success-msg, .error-msg {
      padding: 10px;
      border-radius: 5px;
      margin: 10px 0;
      text-align: center;
    }
    .success-msg {
      background-color: #d4edda;
      color: #155724;
    }
    .error-msg {
      background-color: #f8d7da;
      color: #721c24;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="container">
    <h3>Título da História:</h3>
    <form action="" method="post">
      <label for="titule">Título da História:</label>
      <input type="text" id="titule" name="titule" required>

      <label for="link">Link da Imagem de Capa:</label>
      <input type="url" id="link" name="link" required>

      <label for="history">Sinopse da História:</label>
      <textarea id="history" name="history" rows="10" cols="50" style="resize: both;" required></textarea>

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

      <input type="checkbox" id="declaration" name="declaration" value="agree" required>
      <label for="declaration"> Declaro que essa História é de minha autoria e está de acordo com as Diretrizes de Conteúdo e os Termos de Uso do Neverland</label><br><br>
      
      <input type="submit" value="Enviar História">
    </form>
  </div>
</body>
</html>
