const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');

const app = express();
const port = 3000;

app.use(bodyParser.json()); // Configura o middleware para interpretar JSON no corpo das requisições

app.post('/send-email', (req, res) => {
    const { recipient, subject, message } = req.body;

    // Configuração do transporte de email usando o Nodemailer
    const transporter = nodemailer.createTransport({
        service: 'Gmail', // Usando o serviço Gmail (não recomendado para produção)
        auth: {
            user: 'ale.fazer.bosta@gmail.com', // Substitua pelo seu email
            pass: 'ale13102005' // Substitua pela sua senha
        }
    });

    // Opções do email a ser enviado
    const mailOptions = {
        from: 'seu_email@gmail.com', // Seu email
        to: recipient, // Email do destinatário
        subject: subject, // Assunto do email
        text: message // Conteúdo do email (texto simples)
    };

    // Envia o email
    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error('Erro ao enviar o email:', error);
            res.json({ success: false }); // Envia uma resposta indicando falha
        } else {
            console.log('Email enviado:', info.response);
            res.json({ success: true }); // Envia uma resposta indicando sucesso
        }
    });
});

app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});