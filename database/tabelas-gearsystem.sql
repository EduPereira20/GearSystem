CREATE DATABASE gearSystem;

USE gearSystem;

create table usuario (
    id int auto_increment primary key,
    nome_completo varchar(80),
    documento varchar(15),
    email varchar(50),
    usuario varchar(30),
    senha varchar(20),
    data_cadastro datetime,
    telefone varchar(11),
    setor varchar(45)
);

create table administradores (
    id int auto_increment primary key,
    nome_completo varchar(80),
    documento varchar(15),
    email varchar(50),
    cargo varchar(45),
    usuario varchar(30),
    senha varchar(20),
    telefone varchar(11)
);

create table cliente (
    id int auto_increment primary key,
    nome_completo varchar(45),
    razao_social varchar(45),
    documento varchar(15),
    telefone varchar(11),
    email varchar(50)
);

create table mecanicos (
    id int auto_increment primary key,
    nome_completo varchar(45),
    especialidade varchar(45),
    numero_registro int,
    telefone varchar(11),
    email varchar(50)
);

create table tipo_servico (
    id int auto_increment primary key,
    servico varchar(80),
    descricao mediumtext,
    tempo_estimado varchar(10),
    valor_base decimal(10,2),
    categoria_veicular varchar(45),
    nivel_dificuldade enum('baixo','medio','alto'),
    data_insercao date
);

create table ordem_servico (
    id int auto_increment primary key,
    data_abertura datetime,
    data_previsao_entrega date,
    data_encerramento date,
    descricao_problema mediumtext,
    modelo_veiculo varchar(50),
    placa_veiculo char(7),
    quilometragem_veiculo int,
    usuario_id int,
    mecanicos_id int,
    cliente_id int,
    status int,

    foreign key (usuario_id) references usuario(id),
    foreign key (mecanicos_id) references mecanicos(id),
    foreign key (cliente_id) references cliente(id)
);

create table ordemservico_tiposervico (
    ordem_servico_id int,
    tipo_servico_id int,

    primary key (ordem_servico_id, tipo_servico_id),

    foreign key (ordem_servico_id) references ordem_servico(id),
    foreign key (tipo_servico_id) references tipo_servico(id)
);