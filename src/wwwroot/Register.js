import React, { useState } from 'react';
import axios from 'axios';

const Register = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const register = () => {
        axios.post('http://localhost:3001/register', {
            username: username,
            password: password
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
                type="password"
                placeholder="Password"
                onChange={(e) => setPassword(e.target.value)}
            />
            <button onClick={register}>Cadastrar</button>
        </div>
    );
};

export default Register;
