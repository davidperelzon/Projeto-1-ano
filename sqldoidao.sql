-- Criar o banco de dados (caso ainda não exista)
CREATE DATABASE IF NOT EXISTS clebin;
USE clebin;

-- Criar tabela de contatos
CREATE TABLE contato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    endereco_buraco VARCHAR(200) NOT NULL,
    descricao TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
