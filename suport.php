<html>
<link rel="stylesheet" href="css/index.css">

    <body>

<main class="container">

        <section class="support">
            <h2>Contato</h2>
            <form action="submit_support.php" method="POST">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Mensagem:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                <input type="submit" value="Enviar">
            </form>
        </section>
    </main>
    </body>
</html>