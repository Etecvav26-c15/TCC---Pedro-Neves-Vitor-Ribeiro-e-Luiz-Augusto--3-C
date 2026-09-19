<?php
/**
 * Controller para funcionalidades do aluno
 */
class AlunoController {
    private $db;
    private $alunoId;

    public function __construct($alunoId) {
        $this->db = Database::getInstance();
        $this->alunoId = $alunoId;
    }

    public function getDashboardData() {
        $aluno = $this->db->fetch(
            "SELECT u.nome, u.matricula, t.nome as turma, t.id as turma_id
             FROM usuarios u
             JOIN alunos_turma at2 ON u.id = at2.aluno_id
             JOIN turmas t ON at2.turma_id = t.id
             WHERE u.id = ? AND at2.status = 'cursando' AND at2.ano_letivo = YEAR(CURDATE())",
            [$this->alunoId]
        );
        $msgNaoLidas = $this->db->fetch(
            "SELECT COUNT(*) as total FROM mensagens WHERE (destinatario_tipo = 'aluno' AND destinatario_id = ?) OR destinatario_tipo = 'todos'",
            [$this->alunoId]
        )['total'];
        return ['aluno' => $aluno, 'msgNaoLidas' => $msgNaoLidas];
    }

    public function getHorarios() {
        $turma = $this->db->fetch(
            "SELECT turma_id FROM alunos_turma WHERE aluno_id = ? AND status = 'cursando' AND ano_letivo = YEAR(CURDATE())",
            [$this->alunoId]
        );
        if (!$turma) return [];
        return $this->db->fetchAll(
            "SELECT h.dia_semana, h.horario_inicio, h.horario_fim, m.nome as materia, u.nome as professor
             FROM horarios_aula h
             JOIN professor_turma_materia ptm ON h.professor_turma_materia_id = ptm.id
             JOIN materias m ON ptm.materia_id = m.id
             JOIN usuarios u ON ptm.professor_id = u.id
             WHERE ptm.turma_id = ? AND ptm.ano_letivo = YEAR(CURDATE())
             ORDER BY FIELD(h.dia_semana, 'segunda','terca','quarta','quinta','sexta','sabado'), h.horario_inicio",
            [$turma['turma_id']]
        );
    }

    public function getBoletim() {
        return $this->db->fetchAll(
            "SELECT n.bimestre, n.nota, m.nome as materia, n.ano_letivo
             FROM notas n
             JOIN materias m ON n.materia_id = m.id
             WHERE n.aluno_id = ? AND n.ano_letivo = YEAR(CURDATE())
             ORDER BY m.nome, n.bimestre",
            [$this->alunoId]
        );
    }

public function getFaltas() {
    return $this->db->fetchAll(
        "SELECT 
            m.nome AS materia,

            SUM(CASE 
                WHEN ca.presenca = 'presente' THEN 1 
                ELSE 0 
            END) AS presencas,

            SUM(CASE 
                WHEN ca.presenca = 'ausente' THEN 1 
                ELSE 0 
            END) AS faltas,

            SUM(CASE 
                WHEN ca.presenca = 'justificado' THEN 1 
                ELSE 0 
            END) AS justificadas

        FROM chamada_alunos ca

        JOIN chamadas c 
            ON ca.chamada_id = c.id

        JOIN materias m 
            ON c.materia_id = m.id

        WHERE ca.aluno_id = ?
          AND YEAR(c.data_aula) = YEAR(CURDATE())

        GROUP BY m.id, m.nome

        ORDER BY m.nome",
        
        [$this->alunoId]
    );
}

    public function getMensagens() {
        return $this->db->fetchAll(
            "SELECT m.id, m.titulo, m.conteudo, m.data_envio, u.nome as remetente
             FROM mensagens m
             JOIN usuarios u ON m.remetente_id = u.id
             WHERE (m.destinatario_tipo = 'todos')
                OR (m.destinatario_tipo = 'aluno' AND m.destinatario_id = ?)
             ORDER BY m.data_envio DESC",
            [$this->alunoId]
        );
    }

    public function gerarDeclaracao() {
        $aluno = $this->db->fetch(
            "SELECT u.nome, u.matricula, t.nome as turma, at2.ano_letivo
             FROM usuarios u
             JOIN alunos_turma at2 ON u.id = at2.aluno_id
             JOIN turmas t ON at2.turma_id = t.id
             WHERE u.id = ? AND at2.status = 'cursando'",
            [$this->alunoId]
        );
        if (!$aluno) return null;
        $codigo = strtoupper(substr(md5(uniqid()), 0, 16));
        $this->db->insert(
            "INSERT INTO declaracoes_matricula (aluno_id, turma_id, ano_letivo, codigo_verificacao) VALUES (?, ?, ?, ?)",
            [$this->alunoId, $aluno['turma_id'] ?? 1, $aluno['ano_letivo'] ?? date('Y'), $codigo]
        );
        return ['aluno' => $aluno, 'codigo' => $codigo, 'data' => date('d/m/Y')];
    }
}