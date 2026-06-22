<?php
/**
 * Controller para funcionalidades do professor
 */
class ProfessorController {
    private $db;
    private $professorId;

    public function __construct($professorId) {
        $this->db = Database::getInstance();
        $this->professorId = $professorId;
    }

    public function getTurmas() {
        return $this->db->fetchAll(
            "SELECT DISTINCT t.id, t.nome FROM turmas t
             JOIN professor_turma_materia ptm ON t.id = ptm.turma_id
             WHERE ptm.professor_id = ? AND ptm.ano_letivo = YEAR(CURDATE())",
            [$this->professorId]
        );
    }

    public function getMateriasPorTurma($turmaId) {
        return $this->db->fetchAll(
            "SELECT m.id, m.nome FROM materias m
             JOIN professor_turma_materia ptm ON m.id = ptm.materia_id
             WHERE ptm.professor_id = ? AND ptm.turma_id = ? AND ptm.ano_letivo = YEAR(CURDATE())",
            [$this->professorId, $turmaId]
        );
    }

    public function getAlunosDaTurma($turmaId) {
        return (new Turma())->getAlunos($turmaId);
    }

    public function registrarChamada($turmaId, $materiaId, $dataAula, $presencas) {
        $chamadaId = $this->db->insert(
            "INSERT INTO chamadas (professor_id, turma_id, materia_id, data_aula) VALUES (?, ?, ?, ?)",
            [$this->professorId, $turmaId, $materiaId, $dataAula]
        );
        foreach ($presencas as $alunoId => $status) {
            $this->db->query(
                "INSERT INTO chamada_alunos (chamada_id, aluno_id, presenca) VALUES (?, ?, ?)",
                [$chamadaId, $alunoId, $status]
            );
        }
        return $chamadaId;
    }

    public function lancarNotas($turmaId, $materiaId, $bimestre, $anoLetivo, $notas) {
        foreach ($notas as $alunoId => $nota) {
            $this->db->query(
                "INSERT INTO notas (aluno_id, materia_id, turma_id, professor_id, bimestre, ano_letivo, nota)
                 VALUES (?, ?, ?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE nota = ?, updated_at = NOW()",
                [$alunoId, $materiaId, $turmaId, $this->professorId, $bimestre, $anoLetivo, $nota, $nota]
            );
        }
    }

    public function salvarPlanoAula($materiaId, $titulo, $conteudo, $dataPlano) {
        return $this->db->insert(
            "INSERT INTO planos_aula (professor_id, materia_id, titulo, conteudo, data_plano) VALUES (?, ?, ?, ?, ?)",
            [$this->professorId, $materiaId, $titulo, $conteudo, $dataPlano]
        );
    }
}