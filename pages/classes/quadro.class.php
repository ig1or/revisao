<?php
require_once('database.class.php');
require_once('quadrado.class.php');
require_once('circulo.class.php');
require_once('triangulo.class.php');
require_once('retangulo.class.php');

class Quadro {
    private $id;
    private $nome;
    private $formas;

    public function __construct($id, $nome) {
        $this->setId($id);
        $this->setNome($nome);
        $this->formas = array();
        $quadrados = Quadrado::listar(3, $id);
        foreach ($quadrados as $quadrado) {
            $this->addForma(new Quadrado($quadrado['id'], $quadrado['lado'], $quadrado['cor'], $quadrado['un'], $quadrado['id_quadro']));
        }
        $circulos = Circulo::listar(3, $id);
        foreach ($circulos as $circulo) {
            $this->addForma(new Circulo($circulo['id'], $circulo['raio'], $circulo['cor'], $circulo['un'], $circulo['id_quadro']));
        }
        $retangulos = Retangulo::listar(3, $id);
        foreach ($retangulos as $retangulo) {
            $this->addForma(new Retangulo($retangulo['id'], $retangulo['largura'], $retangulo['altura'], $retangulo['cor'], $retangulo['un'], $retangulo['id_quadro']));
        }
        $triangulos = Triangulo::listar(3, $id);
        foreach ($triangulos as $triangulo) {
            $this->addForma(new Triangulo($triangulo['id'], $triangulo['lado1'], $triangulo['lado2'], $triangulo['lado3'], $triangulo['cor'], $triangulo['un'], $triangulo['tipo'], $triangulo['id_quadro']));
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getFormas() {
        return $this->formas;
    }

    public function addForma(Forma $forma) {
        $this->formas[] = $forma;
    }

    public function listarFormas() {
        foreach ($this->formas as $forma) {
            echo $forma->desenhar();
        }
    }

    public function inserir() {
        $sql = 'INSERT INTO quadro (id, nome) VALUES (:id, :nome)';
        $params = array(
            ':id' => $this->getId(),
            ':nome' => $this->getNome()
        );

        return Database::executar($sql, $params);
    }

    public function excluir() {
        $sql = 'DELETE FROM quadro WHERE id = :id';
        $params = array(':id' => $this->getId());
        return Database::executar($sql, $params);
    }

    public function editar() {
        $sql = 'UPDATE quadro SET nome = :nome WHERE id = :id';
        $params = array(
            ':id' => $this->getId(),
            ':nome' => $this->getNome()
        );
        return Database::executar($sql, $params);
    }

    public static function listar($tipo = 0, $info = '') {
        $sql = 'SELECT * FROM quadro';
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
}

?>