CREATE DATABASE IF NOT EXISTS eletrodomesticos
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE eletrodomesticos;

CREATE TABLE IF NOT EXISTS cliente (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_cliente_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS produto (
    id_prod INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_prod)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS promocao (
    id_promo INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_promo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS vendas (
    id_ve INT NOT NULL AUTO_INCREMENT,
    data_emissao DATE NOT NULL,
    forma_pgto VARCHAR(50) NOT NULL,
    id_cliente INT NOT NULL,
    total_nota DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    numero_itens INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_ve),
    KEY idx_vendas_cliente (id_cliente),
    CONSTRAINT fk_vendas_cliente
        FOREIGN KEY (id_cliente) REFERENCES cliente (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS vendas_item (
    id_item INT NOT NULL AUTO_INCREMENT,
    id_produto INT NULL,
    id_promocao INT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    id_venda INT NOT NULL,
    total_item DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (id_item),
    KEY idx_vendas_item_produto (id_produto),
    KEY idx_vendas_item_promocao (id_promocao),
    KEY idx_vendas_item_venda (id_venda),
    CONSTRAINT fk_vendas_item_produto
        FOREIGN KEY (id_produto) REFERENCES produto (id_prod),
    CONSTRAINT fk_vendas_item_promocao
        FOREIGN KEY (id_promocao) REFERENCES promocao (id_promo),
    CONSTRAINT fk_vendas_item_venda
        FOREIGN KEY (id_venda) REFERENCES vendas (id_ve)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;