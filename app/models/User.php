<?php
/**
 * Modelo para operações com usuários
 * Interage com a tabela 'usuarios'
 */
class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Busca usuário por ID
     */
    public function findById($id) {
        return $this->db->fetch("SELECT * FROM usuarios WHERE id = ?", [$id]);
    }

    /**
     * Busca usuário por email
     */
    public function findByEmail($email) {
        return $this->db->fetch("SELECT * FROM usuarios WHERE email = ?", [$email]);
    }

    /**
     * Cria um novo usuário
     */
    public function create($data) {
        $sql = "INSERT INTO usuarios (nome, email, encrypted_password, tipo, matricula, cpf, telefone, data_nascimento)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->insert($sql, [
            $data['nome'],
            $data['email'],
            $data['encrypted_password'],
            $data['tipo'],
            $data['matricula'] ?? null,
            $data['cpf'] ?? null,
            $data['telefone'] ?? null,
            $data['data_nascimento'] ?? null
        ]);
    }

    /**
     * Atualiza dados de um usuário
     */
    public function update($id, $data) {
        $fields = [];
        $params = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $id;
        $sql = "UPDATE usuarios SET " . implode(', ', $fields) . " WHERE id = ?";
        return $this->db->query($sql, $params);
    }

    /**
     * Lista usuários por tipo
     */
    public function findByType($type) {
        return $this->db->fetchAll("SELECT id, nome, email, matricula, ativo, ultimo_login FROM usuarios WHERE tipo = ? ORDER BY nome", [$type]);
    }
}