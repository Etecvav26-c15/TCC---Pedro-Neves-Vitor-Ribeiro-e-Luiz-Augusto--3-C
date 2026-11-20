<?php
/**
 * Modelo para operações com turmas
 */
class Turma {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findById($id) {
        return $this->db->fetch("SELECT * FROM turmas WHERE id = ?", [$id]);
    }

    public function all() {
        return $this->db->fetchAll("SELECT * FROM turmas WHERE ativo = 1 ORDER BY nome");
    }

    public function create($data) {
        $sql = "INSERT INTO turmas (nome, ano_letivo, turno, sala, capacidade) VALUES (?, ?, ?, ?, ?)";
        return $this->db->insert($sql, [
            $data['nome'],
            $data['ano_letivo'] ?? date('Y'),
            $data['turno'] ?? 'matutino',
            $data['sala'] ?? '',
            $data['capacidade'] ?? 40
        ]);
    }

    /**
     * Retorna alunos matriculados em uma turma
     */
    public function getAlunos($turmaId, $anoLetivo = null) {
        $ano = $anoLetivo ?? date('Y');
        $sql = "SELECT u.id, u.nome, u.matricula FROM usuarios u
                JOIN alunos_turma at2 ON u.id = at2.aluno_id
                WHERE at2.turma_id = ? AND at2.ano_letivo = ? AND at2.status = 'cursando'
                ORDER BY u.nome";
        return $this->db->fetchAll($sql, [$turmaId, $ano]);
    }
}