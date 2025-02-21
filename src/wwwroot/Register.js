import React, { useState } from 'react'; // Importa React e useState
import axios from 'axios'; // Importa axios para fazer requisições HTTP

const Register = () => {
    const [username, setUsername] = useState(''); // Cria um estado para o username
    const [password, setPassword] = useState(''); // Cria um estado para o password
    const [email, setEmail] = useState(''); // Cria um estado para o email
    const [cell, setCell] = useState(''); // Cria um estado para o celular
    const [role, setRole] = useState(''); // Cria um estado para o papel do usuário

    // Função para registrar o usuário
    const register = () => {
        // Verifica se todos os campos estão preenchidos
        if (!username || !password || !email || !cell || !role) {
            alert('Por favor, preencha todos os campos');
            return;
        }

        // Envia os dados ao servidor
        axios.post('http://localhost:3001/register', {
            username: username,
            password: password,
            email: email,
            cell: cell,
            role: role 
        }).then(response => {
            alert(response.data); // Exibe a resposta do servidor em um alerta
        }).catch(error => {
            alert(error.response.data); // Exibe o erro do servidor em um alerta
        });
    };

    return (
        <div>
            <h2>Cadastro</h2>
            <input
                type="text"
                placeholder="Username"
                value={username}
                onChange={(e) => setUsername(e.target.value)} // Atualiza o estado do username
            />
            
            <input 
                type="text" 
                placeholder="E-mail"
                value={email}
                onChange={(e) => setEmail(e.target.value)} // Atualiza o estado do email
            />

            <input 
                type="text" 
                placeholder="Celular"
                value={cell}
                onChange={(e) => setCell(e.target.value)} // Atualiza o estado do celular
            />

            <input
                type="password"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)} // Atualiza o estado do password
            />

            <select
                value={role}
                onChange={(e) => setRole(e.target.value)} // Atualiza o estado do papel do usuário
            >
                <option value="" disabled>Selecione o papel</option>
                <option value="0">Leitor(a)</option>
                <option value="1">Autor(a)</option>
            </select>

            <button onClick={register}>Cadastrar</button>
        </div>
    );
};

export default Register; // Exporta o componente Register
