<?php
/**
 * Controller para funcionalidades do coordenador
 */
class CoordenadorController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function cadastrarAluno($data) {
        if (!Validator::email($data['email'])) throw new Exception('Email inválido.');
        $hash = password_hash($data['senha'], PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]);
        $encryptedHash = Encryption::encrypt($hash);
        $userId = (new User())->create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'encrypted_password' => $encryptedHash,
            'tipo' => 'aluno',
            'matricula' => $data['matricula'] ?? null,
        ]);
        // Matricular na turma
        if (!empty($data['turma_id'])) {
            $this->db->query(
                "INSERT INTO alunos_turma (aluno_id, turma_id, ano_letivo, data_matricula) VALUES (?, ?, ?, CURDATE())",
                [$userId, $data['turma_id'], date('Y')]
            );
        }
        return $userId;
    }

    public function cadastrarFuncionario($data, $tipo) {
        if (!in_array($tipo, ['professor', 'coordenador'])) throw new Exception('Tipo inválido.');
        if (!Validator::email($data['email'])) throw new Exception('Email inválido.');
        $hash = password_hash($data['senha'], PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]);
        $encryptedHash = Encryption::encrypt($hash);
        return (new User())->create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'encrypted_password' => $encryptedHash,
            'tipo' => $tipo,
            'matricula' => $data['matricula'] ?? null,
        ]);
    }

    public function criarTurma($nome, $turno, $sala = '', $capacidade = 40) {
        return (new Turma())->create([
            'nome' => $nome,
            'ano_letivo' => date('Y'),
            'turno' => $turno,
            'sala' => $sala,
            'capacidade' => $capacidade
        ]);
    }

    public function designarProfessor($professorId, $turmaId, $materiaId) {
        $sql = "INSERT IGNORE INTO professor_turma_materia (professor_id, turma_id, materia_id, ano_letivo) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, [$professorId, $turmaId, $materiaId, date('Y')]);
    }

    public function getRelatorioGeral() {
        return [
            'total_alunos' => $this->db->fetch("SELECT COUNT(*) as total FROM usuarios WHERE tipo = 'aluno' AND ativo = 1")['total'],
            'total_professores' => $this->db->fetch("SELECT COUNT(*) as total FROM usuarios WHERE tipo = 'professor' AND ativo = 1")['total'],
            'total_turmas' => $this->db->fetch("SELECT COUNT(*) as total FROM turmas WHERE ativo = 1")['total'],
        ];
    }
}