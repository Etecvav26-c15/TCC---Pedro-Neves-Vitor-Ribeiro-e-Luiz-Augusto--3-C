-- database/schema.sql

CREATE DATABASE IF NOT EXISTS school_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE school_db;

-- ============================================================
-- TABELA: usuarios
-- Armazena dados comuns de todos os usuários
-- ============================================================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    encrypted_password TEXT NOT NULL,   -- hash bcrypt criptografado
    tipo ENUM('aluno', 'professor', 'coordenador') NOT NULL,
    matricula VARCHAR(50) UNIQUE,
    cpf VARCHAR(14) UNIQUE,
    telefone VARCHAR(20),
    data_nascimento DATE,
    ativo TINYINT(1) DEFAULT 1,
    ultimo_login DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: turmas
-- ============================================================
CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(10) NOT NULL COMMENT 'Ex: 3C, 2A, 1S',
    ano_letivo YEAR NOT NULL,
    turno ENUM('matutino', 'vespertino', 'noturno', 'integral') NOT NULL,
    sala VARCHAR(20),
    capacidade INT DEFAULT 40,
    ativo TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: materias
-- ============================================================
CREATE TABLE materias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    codigo VARCHAR(20) UNIQUE,
    descricao TEXT,
    carga_horaria INT,
    ativo TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: professor_turma_materia (relacionamento ternário)
-- ============================================================
CREATE TABLE professor_turma_materia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    turma_id INT NOT NULL,
    materia_id INT NOT NULL,
    ano_letivo YEAR NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES usuarios(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id),
    UNIQUE KEY unq_prof_turma_mat (professor_id, turma_id, materia_id, ano_letivo)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: alunos_turma
-- ============================================================
CREATE TABLE alunos_turma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    ano_letivo YEAR NOT NULL,
    data_matricula DATE NOT NULL,
    status ENUM('cursando', 'transferido', 'concluido', 'evadido') DEFAULT 'cursando',
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: horarios_aula
-- ============================================================
CREATE TABLE horarios_aula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_turma_materia_id INT NOT NULL,
    dia_semana ENUM('segunda','terca','quarta','quinta','sexta','sabado') NOT NULL,
    horario_inicio TIME NOT NULL,
    horario_fim TIME NOT NULL,
    FOREIGN KEY (professor_turma_materia_id)
        REFERENCES professor_turma_materia(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: chamadas
-- ============================================================
CREATE TABLE chamadas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    turma_id INT NOT NULL,
    materia_id INT NOT NULL,
    data_aula DATE NOT NULL,
    FOREIGN KEY (professor_id) REFERENCES usuarios(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id)
) ENGINE=InnoDB;

CREATE TABLE chamada_alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chamada_id INT NOT NULL,
    aluno_id INT NOT NULL,
    presenca ENUM('presente', 'ausente', 'justificado') NOT NULL DEFAULT 'ausente',
    FOREIGN KEY (chamada_id) REFERENCES chamadas(id) ON DELETE CASCADE,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: notas
-- ============================================================
CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    materia_id INT NOT NULL,
    turma_id INT NOT NULL,
    professor_id INT NOT NULL,
    bimestre ENUM('1','2','3','4') NOT NULL,
    ano_letivo YEAR NOT NULL,
    nota ENUM('I','R','B','MB','NA') NOT NULL DEFAULT 'NA',
    observacao TEXT,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id),
    FOREIGN KEY (professor_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: faltas (consolidada por matéria)
-- ============================================================
CREATE TABLE faltas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    materia_id INT NOT NULL,
    turma_id INT NOT NULL,
    ano_letivo YEAR NOT NULL,
    total_faltas INT DEFAULT 0,
    FOREIGN KEY (aluno_id) REFERENCES usuarios(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: planos_aula
-- ============================================================
CREATE TABLE planos_aula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    professor_id INT NOT NULL,
    materia_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    data_plano DATE NOT NULL,
    status ENUM('rascunho', 'enviado', 'aprovado') DEFAULT 'enviado',
    FOREIGN KEY (professor_id) REFERENCES usuarios(id),
    FOREIGN KEY (materia_id) REFERENCES materias(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: mensagens
-- ============================================================
CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remetente_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    destinatario_tipo ENUM('todos','aluno','professor','turma') NOT NULL,
    destinatario_id INT DEFAULT NULL,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    lida TINYINT(1) DEFAULT 0,
    FOREIGN KEY (remetente_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: tokens_recuperacao (esqueci minha senha)
-- ============================================================
CREATE TABLE tokens_recuperacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token VARCHAR(128) NOT NULL UNIQUE,
    expira_em DATETIME NOT NULL,
    usado TINYINT(1) DEFAULT 0,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- TABELA: logs_sistema
-- ============================================================
CREATE TABLE logs_sistema (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    acao VARCHAR(100),
    descricao TEXT,
    ip VARCHAR(45),
    user_agent TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Índices auxiliares
CREATE INDEX idx_notas_aluno ON notas(aluno_id, ano_letivo);
CREATE INDEX idx_chamadas_data ON chamadas(data_aula);