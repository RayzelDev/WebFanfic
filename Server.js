const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

const db = mysql.createConnection({
    host: '127.0.0.1',
    user: 'root',
    password: '46984698',
    database: 'FanficDB'
});

db.connect(err => {
    if (err) throw err;
    console.log('Conectado ao banco de dados MySQL');
});

app.post('/register', (req, res) => {
    const { username, email, cell, role, password } = req.body;
    const sql = `INSERT INTO users (username, email, cell, role, password) VALUES (?, ?, ?, ?, ?)`;
    db.query(sql, [username, email, cell, role, password], (err, result) => {
        if (err) throw err;
        res.send('Usuário registrado com sucesso!');
        console.log(res);
    });
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    const sql = `SELECT * FROM users WHERE username = ? AND password = ?`;
    db.query(sql, [username, password], (err, result) => {
        if (err) throw err;
        if (result.length > 0) {
            res.send('Login bem-sucedido');
        } else {
            res.send('Usuário ou senha incorretos');
        }
    });
});

app.listen(3001, () => {
    console.log('Servidor rodando na porta 3001');
});
