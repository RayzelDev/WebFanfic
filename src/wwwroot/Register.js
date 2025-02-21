import React, { useState } from 'react';
import axios from 'axios';

const Register = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [email, setEmail] = useState('');
    const [cell, setCell] = useState('');
    const [role, setRole] = useState('auto');  // Novo estado para armazenar o valor do select

    const register = () => {
        axios.post('http://localhost:3001/register', {
            username: username,
            password: password,
            email: email,
            cell: cell,
            role: role  // Enviando o valor da seleção para o backend
        }).then(response => {
            alert(response.data);
        });
    };

    return (
        <div>
            <h2>Cadastro</h2>
            <input
                type="text"
                placeholder="Username"
                onChange={(e) => setUsername(e.target.value)}
            />
            
            <input 
                type="text" 
                placeholder="E-mail"
                onChange={(e) => setEmail(e.target.value)}
            />

            <input 
                type="text" 
                placeholder="+55 21 90123-4567"
                onChange={(e) => setCell(e.target.value)}
            />

            <input
                type="password"
                placeholder="Password"
                onChange={(e) => setPassword(e.target.value)}
            />

            <select
                value={role}
                onChange={(e) => setRole(e.target.value)}
            >
                <option value="0">Leitor(a)</option>
                <option value="1r">Autorr(a)</option>
            </select>

            <button onClick={register}>Cadastrar</button>
        </div>
    );
};

export default Register;
