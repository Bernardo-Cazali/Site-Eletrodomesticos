# 🛒 Elemax - Sistema E-commerce de Eletrodomésticos

Projeto desenvolvido como requisito avaliativo de uma matéria do 4º semestre do curso técnico em informática. Trata-se de uma aplicação web voltada para o comércio eletrônico de eletrodomésticos, contemplando fluxo completo de cadastro de usuários, gestão de produtos, carrinho de compras e controle de pedidos.

---

## 📸 Demonstração do Sistema

| Tela Inicial / Catálogo | Tela da venda finalizada |
| :---: | :---: |
| ![Home Page](imagem/print-home.png) | ![Carrinho](imagem/print-venda.png) |

---

## 🚀 Tecnologias Utilizadas

- **PHP:** Lógica de backend e manipulação de sessões/dados.
- **JavaScript:** Interatividade no lado do cliente e validações.
- **MySQL:** Banco de dados relacional para persistência de dados (usuários, produtos e pedidos).
- **HTML5 & CSS3:** Estruturação e estilização das interfaces.

---

## ✨ Funcionalidades

- **Autenticação:** Sistema de cadastro e login de usuários (`cadastro.php`, `login.php`).
- **Catálogo e Promoções:** Visualização de produtos em destaque e páginas específicas de ofertas (`promocao.php`).
- **Carrinho de Compras:** Adição de itens, controle de fluxo e finalização de pedidos (`carrinho.php`, `finalizar.php`, `pedidos.php`).
- **Conexão com Banco de Dados:** Módulo centralizado para comunicação segura com o MySQL (`conexao.php`).

---

## 📁 Estrutura do Repositório

```text
├── database/              # Scripts e estrutura do banco de dados MySQL
├── imagem/ & img/         # Ativos visuais e imagens dos eletrodomésticos
├── cadastro.php           # Tela de registro de novos usuários
├── carrinho.php           # Gestão do carrinho de compras
├── conexao.exemplo.php    # Conexão Conexão MySQLi com o banco
├── css.css                # Estilos globais da aplicação
├── finalizar.php          # Lógica de fechamento de pedido
├── inicio.php             # Página inicial (Home) do sistema
├── js.js                  # Scripts e manipulação do DOM em JavaScript
├── login.php              # Tela de autenticação
├── menu.php               # Componente de navegação reutilizável
├── pedidos.php            # Histórico/visualização de pedidos
├── produto.php            # Cadastra produtos
├── promocao.php           # Página de ofertas
└── sobre.html             # Página institucional sobre a loja
```

---

## 🛠️ Como Executar o Projeto Localmente

### 1. Baixe o projeto

No PowerShell, acesse a pasta `htdocs` do XAMPP e clone o repositório:

```powershell
cd C:\xampp\htdocs
git clone https://github.com/Bernardo-Cazali/Site-Eletrodomesticos.git
```

Se preferir, também dá para baixar o ZIP do repositório e extrair dentro de `htdocs`.

### 2. Inicie o ambiente

Abra o XAMPP Control Panel e inicie os serviços **Apache** e **MySQL**.

### 3. Crie a estrutura do banco de dados

No MySQL Workbench, abra o arquivo `database/estrutura.sql` e execute o script. Ele cria o banco `eletrodomesticos` e as tabelas usadas pelo sistema; não é necessário criar o banco manualmente.

### 4. Configure a conexão

Na pasta do projeto, faça uma cópia de `conexao.exemplo.php` e renomeie a cópia para `conexao.php`. Abra esse arquivo e preencha os dados de conexão do seu MySQL/MariaDB. A conta usada precisa ter acesso ao banco `eletrodomesticos`.

> O arquivo `conexao.php` é local e está fora do repositório para proteger as credenciais. Não publique sua senha no GitHub.

### 5. Abra o site

Acesse no navegador:

[http://localhost/Site-Eletrodomesticos/inicio.php](http://localhost/Site-Eletrodomesticos/inicio.php)

Se você extraiu o projeto com outro nome de pasta, troque `Site-Eletrodomesticos` pelo nome usado.

> O script cria as tabelas, mas não inclui produtos de exemplo. Cadastre produtos e promoções para preencher o catálogo.
