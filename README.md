# 💡 Desafio Revvo

## 📌 Tecnologias utilizadas
- Frontend: Html, Css e Javascript
- Backend: PHP
- Banco de Dados: MySQL
- Insfraestrutura: Docker e Docker Compose

## 💡 Sobre o Projeto
Projeto feito com finalidade de avaliação. Collection para testes com a API está no repositório com o nome: Collection_Desafio_Revvo.json

## ⚙️ Instalação

### Pré-requisitos
- Docker
- Docker Compose

### Passos
1. Clone o repositório:
   ```sh
   git clone https://github.com/silas-junior/desafio_revvo.git
   
2. Faça o build dos containers do Docker:
   ```sh
   docker-compose up -d ou docker-compose up -d --build

3. Ao finalizar o build, execute um teste da conexão com o banco de dados:
   ```sh
   docker exec -it revvo_backend php backend/database/test_db.php
   
4. Caso a conexão tenha sido bem sucedida, execute o comando para criar as tabelas no banco de dados:
   ```sh
   docker exec -it revvo_backend php backend/database/migrator.php

5. Após isso, caso queira acessar o phpMyAdmin para ver o banco, acesse isso no seu navegador: localhost:7001.
   ```sh
   Usuário: root
   Senha: root
   
6. Logo em seguida, digite isso no seu navegador: localhost:8001 para visualizar o painel.
   
