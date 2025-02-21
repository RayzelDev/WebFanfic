const express = require('express'); // Importa o framework Express
const mysql = require('mysql'); // Importa o módulo MySQL para interagir com o banco de dados
const bodyParser = require('body-parser'); // Importa o body-parser para lidar com dados JSON
const cors = require('cors'); // Importa o CORS para permitir requisições de outros domínios

const app = express(); // Cria uma instância do Express
app.use(cors()); // Ativa o CORS no app
app.use(bodyParser.json()); // Configura o app para usar JSON no body das requisições

// Configuração do banco de dados MySQL
const db = mysql.createConnection({
    host: '127.0.0.1', // Endereço do servidor MySQL
    user: 'root', // Usuário do banco de dados
    password: '46984698', // Senha do banco de dados
    database: 'FanficDB' // Nome do banco de dados
});

db.connect(err => {
    if (err) throw err; // Lança um erro se a conexão falhar
    console.log('Conectado ao banco de dados MySQL'); // Exibe uma mensagem de sucesso na conexão
});

// Rota de registro de usuário
app.post('/register', (req, res) => {
    const { username, email, cell, role, password } = req.body; // Desestrutura o corpo da requisição para obter dados do usuário

    // Verificando se o usuário, e-mail ou celular já existem
    const checkUser = 'SELECT * FROM users WHERE username = ?';
    const checkEmail = 'SELECT * FROM users WHERE email = ?';
    const checkCell = 'SELECT * FROM users WHERE cell = ?';

    // Verificar se o nome de usuário já existe
    db.query(checkUser, [username], (err, result) => {
        if (err) return res.status(500).send('Erro no servidor'); // Lança um erro se a query falhar
        if (result.length > 0) {
            return res.status(400).send('Usuário já existe');
        }

        // Verificar se o e-mail já existe
        db.query(checkEmail, [email], (err, result) => {
            if (err) return res.status(500).send('Erro no servidor'); // Lança um erro se a query falhar
            if (result.length > 0) {
                return res.status(400).send('E-mail já cadastrado');
            }

            // Verificar se o celular já existe
            db.query(checkCell, [cell], (err, result) => {
                if (err) return res.status(500).send('Erro no servidor'); // Lança um erro se a query falhar
                if (result.length > 0) {
                    return res.status(400).send('Celular já cadastrado');
                }

                // Inserir o novo usuário no banco de dados
                const sql = `INSERT INTO users (username, email, cell, role, password) VALUES (?, ?, ?, ?, ?)`;
                db.query(sql, [username, email, cell, role, password], (err, result) => {
                    if (err) return res.status(500).send('Erro no servidor'); // Lança um erro se a query falhar
                    res.send('Usuário registrado com sucesso!');
                    console.log(result); // Exibe o resultado no console para depuração
                });
            });
        });
    });
});

// Rota de login
app.post('/login', (req, res) => {
    const { username, password } = req.body; // Desestrutura o corpo da requisição para obter username e password
    const sql = `SELECT * FROM users WHERE username = ? AND password = ?`; // Query SQL para selecionar o usuário
    db.query(sql, [username, password], (err, result) => {
        if (err) return res.status(500).send('Erro no servidor'); // Lança um erro se a query falhar
        if (result.length > 0) {
            res.send('Login bem-sucedido'); // Envia uma resposta de sucesso se o usuário for encontrado
        } else {
            res.status(400).send('Usuário ou senha incorretos'); // Envia uma resposta de erro se o usuário não for encontrado
        }
    });
});

app.listen(3001, () => {
    console.log('Servidor rodando na porta 3001'); // Inicia o servidor na porta 3001
});
