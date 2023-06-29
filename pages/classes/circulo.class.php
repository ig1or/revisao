<?php
require_once('forma.class.php');

class Circulo extends Forma {
    private $raio;

    public function __construct($pid, $praio, $pcor, $pun, $pquadro) {
        parent::__construct($pid, '2', $pcor, $pun, $pquadro);
        $this->setRaio($praio);
    }

    public function getRaio() {
        return $this->raio;
    }

    public function setRaio($raio) {
        if ($raio > 0) {
            $this->raio = $raio;
        } else {
            throw new Exception("Raio do círculo inválido. Informe um valor maior que 0");
        }
    }

    public function excluir() {
        $sql = 'DELETE FROM circulo WHERE id = :id';
        $param = array(':id' => $this->getId());
        return Database::executar($sql, $param);
    }

    public function editar() {
        $sql = 'UPDATE circulo SET raio = :raio, cor = :cor, un = :un, id_quadro = :id_quadro WHERE id = :id';
        $param = array(
            'id' => $this->getId(),
            'raio' => $this->getRaio(),
            'cor' => $this->getCor(),
            'un' => $this->getUn(),
            'id_quadro' => $this->getQuadro()
        );
        return Database::executar($sql, $param);
    }

    public function inserir() {
        $sql = "INSERT INTO circulo (raio, cor, un, id_quadro) VALUES (:raio, :cor, :un, :id_quadro)";
        $param = array(
            'raio' => $this->getRaio(),
            'cor' => $this->getCor(),
            'un' => $this->getUn(),
            'id_quadro' => $this->getQuadro()
        );
        return Database::executar($sql, $param);
    }

    public static function listar($tipo = 0, $info = '') {
        $sql = 'SELECT * FROM circulo';
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
                        style='
                            width: {$this->getRaio()}{$this->getUn()};
                            height: {$this->getRaio()}{$this->getUn()};
                            background-color: {$this->getCor()};
                            border-radius: 50%;
                        '>
                    </div>";
        return $desenho;
    }

    public function calcular() {
        $area = pi() * $this->raio * $this->raio;
        $circunferencia = 2 * pi() * $this->raio;

        return array('area' => $area, 'circunferencia' => $circunferencia);
    }

    public function calcularArea() {
        return $this->calcular()['area'];
    }

    public function calcularPerimetro() {
        return $this->calcular()['circunferencia'];
    }
}

?>
