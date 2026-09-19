<?php
/**
 * Modelo para operações com matérias
 */
class Materia {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findById($id) {
        return $this->db->fetch("SELECT * FROM materias WHERE id = ?", [$id]);
    }

    public function all() {
        return $this->db->fetchAll("SELECT * FROM materias WHERE ativo = 1 ORDER BY nome");
    }

    public function create($data) {
        $sql = "INSERT INTO materias (nome, codigo, descricao, carga_horaria) VALUES (?, ?, ?, ?)";
        return $this->db->insert($sql, [$data['nome'], $data['codigo'] ?? null, $data['descricao'] ?? '', $data['carga_horaria'] ?? 0]);
    }

    /**
     * Retorna matérias vinculadas a um professor
     */
    public function getByProfessor($professorId, $anoLetivo = null) {
        $ano = $anoLetivo ?? date('Y');
        $sql = "SELECT DISTINCT m.* FROM materias m
                JOIN professor_turma_materia ptm ON m.id = ptm.materia_id
                WHERE ptm.professor_id = ? AND ptm.ano_letivo = ?";
        return $this->db->fetchAll($sql, [$professorId, $ano]);
    }
}