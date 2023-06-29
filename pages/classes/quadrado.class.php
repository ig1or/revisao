<?php
require_once('forma.class.php');

class Quadrado extends Forma {
    public function __construct($pid, $plado, $pcor, $pun, $pquadro) {
        parent::__construct($pid, $plado, $pcor, $pun, $pquadro);
    }

    public function inserir() {
        $sql = 'INSERT INTO quadrado (lado, cor, un, id_quadro) VALUES (:lado, :cor, :un, :id_quadro)';
        $params = array(
            ':lado' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro' => $this->getQuadro()
        );
        return Database::executar($sql, $params);
    }

    public function excluir() {
        $sql = 'DELETE FROM quadrado WHERE id = :id';
        $params = array(':id' => $this->getId());
        return Database::executar($sql, $params);
    }

    public function editar() {
        $sql = 'UPDATE quadrado SET lado = :lado, cor = :cor, un = :un, id_quadro = :id_quadro WHERE id = :id';
        $params = array(
            ':id' => $this->getId(),
            ':lado' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':un' => $this->getUn(),
            ':id_quadro' => $this->getQuadro()
        );
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = '') {
        $sql = 'SELECT * FROM quadrado';
        switch ($tipo) {
            case 1:
                $sql .= ' WHERE id = :info';
                break;
            case 2:
                $sql .= ' WHERE cor like :info';
                break;
            case 3:
                $sql .= ' WHERE id_quadro = :info';
                break;
        }
        $params = array();
        if ($tipo > 0)
            $params = array(':info' => $info);
        return Database::listar($sql, $params);
    }

    public function desenhar() {
        $desenho = "<div class='desenho'
                    style='width: {$this->getLado()}{$this->getUn()};
                           height: {$this->getLado()}{$this->getUn()};
                           background-color: {$this->getCor()}'>
                    </div>";
        return $desenho;
    }

    public function calcularArea() {
        return $this->getLado() * $this->getLado();
    }

    public function calcularPerimetro() {
        return 4 * $this->getLado();
    }
}

?>